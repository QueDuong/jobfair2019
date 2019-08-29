<?php

/**
 * Front-end class
 * 
 * @package Front
 */
class arvlbFPPL 
{
    /** Main Options */
    private $options = null;

    /**
     * Constructor, initializes options
     */
    function __construct(){
      $this->options = get_option('arv_fb24_opt',arvlbSHARED::getDefaults() );
      
      add_action('wp_enqueue_scripts' , array($this, 'addScript'));
    }

    /**
     * Hook into the footer and add the required Facebook code
     */
    public function addFooter(){
      $o      = $this->options;     
      $extra  = isset($o['extracss']) ? $o['extracss'] : '';

?><div style="display:none">
  <div id="arvlbdata" style="overflow:visible;width:400px;height:250px;">
  <?php if (!empty($o['mab'])) {
    echo $o['mab'];
  } ?>
    <div allowtransparency="true" style="overflow:hidden;width:400px;height:250px;" class="fb-page" 
      data-href="<?php 

      if (!empty($o['fb_id']) && is_numeric($o['fb_id'])){
        echo 'https://www.facebook.com/' . htmlentities($o['fb_id']);
      }else{
        if (!empty($o['fb_id'])){
          $o['fb_id'] = preg_replace('/^.*?facebook\.com\\//i','', $o['fb_id']);
          echo 'https://www.facebook.com/' . htmlentities($o['fb_id']);
        }
      } 
      ?>"
      data-width="400" 
      data-height="250" 
      data-small-header="false" 
      data-adapt-container-width="false" 
      data-hide-cover="true" 
      data-show-facepile="true" 
      data-show-posts="false">
    </div>


</div>

</div>
      <?php
    }

    /**
     * Add all scripts required on the front-end
     */
    public function addScript(){
      $o      = $this->options;
      $page   = $this->getCurrentPage();
      
      if  (
            (! empty($o['display_on_all']) )
            || ($page=='homepage' && !empty($o['display_on_homepage']))
            || ($page=='archive' && !empty($o['display_on_archive']))
            || ($page=='post' && !empty($o['display_on_post']))
            || ($page=='page' && !empty($o['display_on_page']))
            || (!empty($_GET['lightbox']))
      ){
        
        add_action('wp_footer', array($this, 'addFooter'));
       

      if (empty($o['performance']))
        add_action('wp_head', array($this,"compatHead"),-999);//lower order corresponds with earlier execution

      /** register all thre front-end scripts and styles */
      if ( isset($o['min'])  && $o['min']== 1 ){
         wp_enqueue_script ('jquery');
         /* script are enqued with prio 20, we want our script further down the page */
         add_action('wp_footer', array($this, 'minifyInline'), 9000);

      } else {
        $this->registerAssets($o);

      }


     } 
  }

  public function getCurrentPage(){
    if ( is_front_page() && is_home() ) {
      // Default homepage
      return 'homepage';

    } elseif ( is_front_page() ) {
      // static homepage
      return 'homepage';

    //} elseif ( is_home() ) {


    } elseif ( is_archive() ) {
      return 'archive';

    } elseif ( is_single() ) {
      return 'post';

    } elseif ( is_page() ) {
      return 'page';

    } else {
      return '';
    }
}

    /**
     * Add all scripts and styles
     * 
     * @param array $o The option array (pulled from wp_options)
     */
    public function registerAssets($o){
      $min  = (isset($o['min']) && $o['min'] == '2') ? '' : '.min';
      wp_register_style('arevico_scsfbcss', plugins_url( "includes/featherlight/featherlight{$min}.css",__FILE__));
      wp_enqueue_style( 'arevico_scsfbcss'); 

      wp_register_script('arevico_scsfb', plugins_url( "includes/featherlight/featherlight{$min}.js",__FILE__),array('jquery'));
      wp_enqueue_script ('arevico_scsfb');


      wp_register_script('arevico_scsfb_launch',  plugins_url( "includes/launch/launch{$min}.js",__FILE__),array('jquery'));
      wp_enqueue_script ('arevico_scsfb_launch');
      wp_localize_script('arevico_scsfb_launch', 'lb_l_ret',arvlbSHARED::normalize($o) );
    }

  /**
   * Load assets from file into memory and include it in the footer
   *
   */
  public function minifyInline(){
    $o          = $this->options;
    
    $base_inc   = plugin_dir_path( __FILE__ ) . 'includes/';

    $css        = '<style type="text/css">' . @file_get_contents($base_inc . "featherlight/featherlight.min.css") . '</style>';
    $script     = '<script>';

    $script     .= 'var lb_l_ret = ' . wp_json_encode(arvlbSHARED::normalize($o)) . ';';

    // We don't want to have errors, in this particular context it is ok to suppress them'
    $script     .= @file_get_contents($base_inc . 'featherlight/featherlight.min.js');
    $script     .= @file_get_contents($base_inc . "launch/launch.min.js") . '</script>';

    $closeImg   = plugins_url('includes/featherlight/close.png', __FILE__);
    $css = preg_replace('/background\:url\(close\.png\)/', "background:url('{$closeImg}')", $css);
    echo $css . $script;
  }

  /* Compatibility mode */
  public function compatHead(){
    $o = $this->options;
       
   
    echo("<script src='//connect.facebook.net/en_EN/sdk.js#xfbml=1&version=v2.7'></script>");
   
  }

 }

    


/**
 * This class contains shared common properties and/or methods
 */
class arvlbSHARED{
  //Defaults for the option table of this plugin
  public static $defaults = array (
    'fb_id'         => '',
    'delay'         => '2000',
    'show_once'       => '0',
    'display_on_homepage'   => '0',
    'coc'         => '0',
    'cooc'          => '1'  
 );


  /**
   *
   */
  public static function normalize($o){
    $checks = array(
   'width'		   => '400',
   'height'		  => '255',
   'delay'		   => '0',
   'coc'        => '0',
   'fb_id'		   => '' ,
   'cooc'       => '0'
    );

    

    return array_merge($checks,$o);
  }

  public static function getDefaults(){
    $o = self::$defaults;
    return $o;
  }
  
}