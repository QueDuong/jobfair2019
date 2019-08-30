<?php
if (!class_exists('ArevicoSQA')){

/**
 * This class provides some auxiliary functions to aid database processing and HTML outputF$
 *
 * @package Core/Helper
 * @version 1.0
 */
class ArevicoSQA
{

	/**
	 * Retrieve the first element of an array
	 *
	 * @param array &$arr The array of which the first element is to be retrieved
	 * @return mixed the first element of an array
	 */
	public static function firstKey($arr){
		reset($arr);
		return key($arr);
	}

	/**
	 * Retrieve the first element of an array
	 *
	 * @param array &$arr The array of which the first element is to be retrieved
	 * @return mixed the first element of an array
	 */
	public static function lastKey($arr){
		end($arr);
		return key($arr);
	}

	/**
	 * Check if a value is available in the post array and return or output it encoded
	 *
	 * @param string $name the name and subname
	 * @param array|object $arr the array to fetch
	 * @param boolean $echo wether or not to output the current variable
	 * @param boolean $escape wether or not escaping the output is wished
	 * @example ArevicoSQA::val('option[subarray][value]')
	 * @return string the value
	 */
	public static function val($name, $arr = null, $echo = false, $escape = true, $notFound = ''){
		$str_ret 	= 	self::oVal($name, $arr, $notFound);

		if ($escape)
			$str_ret 	= htmlentities($str_ret);

		if ($echo)
			echo $str_ret;

		return $str_ret;
	}

	/**
	 * Set a value of a supplied object
	 * 
	 * @param string $name path notation to an object
	 * @param object &$object the object which we want to have changed
	 * @param mixed $value the new value
	 * @return mixed return the value of the resulting assignment
	 */
	public static function oSet($name, &$object, $value=null){
	   $name    = preg_split('/(\\-\\>|\\[)/', $name); // we can use both the array syntax )[123] or the object one (->)
	   $ret     = $notFound;
	   
	   $o_ref 	= $object;

	   foreach ($name as $keyName) {
		   $keyName     = rtrim($keyName, ']');

		  if ( is_array($o_ref) && isset($o_ref[$keyName] ) ){
			  return $o_ref = &$o_ref[$keyName];

		  } elseif ( is_object($o_ref) && isset($o_refarr->$keyName )){
			 return $o_ref = &$o_ref->$keyName;

		  } else {
			  return $notFound; // no valid entry or no entry at all
		  }
	   }

		return $arr;		
	}

	/**
	 * Get all values of an array not having a specific key
	 *
	 * @param array $arr The array subjected
	 * @param string $x1 .. $n  A variable argument list with array keys.
	 */
	public static function excArray($arr /* , .. , */){
		$args = func_get_args();
		array_shift($args);

		if ( is_array($args[0]) )
			$args = $args[0];

		return array_diff_key($arr, array_flip($args) );
	}
	
	/**
	 * Get all values of an array with a specific key
	 *
	 * @param array $arr The array subjected
	 * @param string $x1 .. $n  A variable argument list with array keys.
	 */
	public static function incArray($arr /* , .. , */){
		$args = func_get_args();
		array_shift($args);

		if ( is_array($args[0]) )
			$args = $args[0];

		return array_intersect_key($arr, array_flip($args) );
	}

	/**
	 * Return a value of a subarray by supplying a path int the form of a[b] or a->b
	 *
	 * @todo Rename to oVal
	 * @param string $name the path to the value e.g(option[subarray][value]) , object properties have the same syntax
	 * @param array|object $arr the array or objectto traverse
	 */
	public static function oVal($name, $arr = null, $notFound = ''){
	if ($arr===null)
			$arr = $_POST;

		if ($name == '')
			return $arr;

	   $name    = preg_split('/(\\-\\>|\\[)/', $name); // we can use both the array syntax )[123] or the object one (->)
	   $ret     = $notFound;

	   foreach ($name as $keyName) {
		   $keyName     = rtrim($keyName, ']');

		  if ( is_array($arr) && isset($arr[$keyName] ) ){
			  $arr = $arr[$keyName];

		  } elseif ( is_object($arr) && isset($arr->$keyName )){
			 $arr = $arr->$keyName;
		  } else {
			  return $notFound; // no valid entry or no entry at all
		  }
	   }

		return $arr;
	}

	/**
	 * Convert parts to an access string for oVal
	*  @param mixed $x1 .. $xn The template parts. If the second parameter is an array, those will be used as parts
	 */
	 public static function getAccessString(){
		 $parts = func_get_args();
		 $parts = isset($parts[0]) && is_array($parts[0]) ? $parts[0] : $parts;

		 if (count($parts) == 0)
		 	return '';

 		 $access_string 	= array_shift($parts);  // The base

		  foreach ($parts as $part)
		  	$access_string .= '[' . $part . ']';

		return $access_string;
	 }

	/**
	 * This function converts an associative array to a single string with all elements
	 * delimited
	 * @param array $assoc the associated array
	 * @param string $delim the delimiter to seperate the values
	 * @return string A string in the format [key="value" ]
	 */
	public static function assocToString($assoc, $delim = ' ', $escape=true){
		global $wpdb;
		$arr_ret = array();

		foreach ($assoc as $key => $value) {
			if ($escape)
				$value=esc_sql($value);
			$arr_ret[]="{$key}=\"{$value}\" ";
		}
		return implode($delim, $arr_ret);
	}

	/**
	 * Return wether or not the current request is a post one
	 * @return bool true if the request is a post
	 */
	public static function isPost(){
		return 	$_SERVER['REQUEST_METHOD']==="POST";
	}

	/**
	 * Returns the full current url being displayed
	 *
	 * @todo WARNING!! Might not play nice with rewrites
	 * @return string the current URL including method and querystring
	 */
	public static function getCurrentURL(){
		//$_SERVER['REQUEST_URI']
		$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https')
				=== FALSE ? 'http' : 'https';
		$host     = $_SERVER['HTTP_HOST'];
		$script   = $_SERVER['SCRIPT_NAME'];
		$params   = $_SERVER['QUERY_STRING'];

		$currentUrl = $protocol . '://' . $host . $script . '?' . $params;

		return $currentUrl;
	}

	/**
	 * Check wether or not a local resource is being accessed
	 *
	 * @param string $url The url
	 */
	public static function isUrlRemote( $url ){
			$url = strtolower($url);
			return strpos($url,'//')  === 0 || strpos($url,'http://')  === 0 || strpos($url,'https://')  === 0;
	}


}

} // End Class Exists Check