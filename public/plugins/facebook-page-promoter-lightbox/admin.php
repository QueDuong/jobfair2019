<?php

require dirname(__FILE__) .'/includes/class-admin-view.php';

/**
 * This admin class intilizes all the admin pages and
 * their required functionality
 * @package Admin
 */
class arvlbAdmin
{

	/* Hold the an instance of the page to be shown (or null if none) */
	protected $admin_view 	= null;

	/**
	 * Reigster the menu, admin pages and setting links
	 */
	function __construct(){
		add_action( 'admin_menu' 		, array($this,'addMenus') );
		add_action( 'current_screen'	, array($this,'processRequest'));
		
		$plugin = plugin_basename(dirname(__FILE__) . '/index.php');
		add_filter("plugin_action_links_{$plugin}", array($this,'add_settings_link' ));

	}

	/**
	 * Process the request of an admin page
	*/
	public function processRequest(){
		/* make sure that we only execute our code if one of our registered page is loaded */
		if ( $this->determinePage() && !empty($_GET['page'])){	

			/* Remove all (in this case: unwanted) quotes */
			$_POST 	  	= stripslashes_deep($_POST);
			$_REQUEST 	= stripslashes_deep($_REQUEST);
			$_GET  		= stripslashes_deep($_GET);
			
			add_action( 'admin_enqueue_scripts', array($this,'load_assets'));
			
			/* If current request is an post request, the user intends to
			   update or save any admin form */
			if (ArevicoSQA::isPost())
				$this->admin_view->save();

			/** Render the page */
			$this->admin_view->processRequest();		
		}
	}
	
	/**
	 * Load all admin scripts and styles
	 */
	public function load_assets(){
		wp_enqueue_style( 'arv-admin-css'		, plugins_url('includes/admin-style/admin.css',__FILE__) );
   		wp_enqueue_script( 'arevico-tab-js'		, plugins_url('includes/admin-style/tab-simple.js',__FILE__) , array('jquery') );
	}

	/**
 	* Determines which page we need to load
	 * @param string $_GET['page'] 
	 */
	private function determinePage(){
		if (!isset($_GET['page']))
			return;

		switch ($_GET['page']) {

			case 'arvlb-tld':
				include dirname(__FILE__) .'/views/class-admin-top.php';
				$this->admin_view = new arvlbAdminTop();

			break;

		}

		return !is_null($this->admin_view);
	}	

	/**
	 * Render the requested page
	 */
	public function renderPage(){
		/* AdminView is guaranteed to be set at this point */
		$this->admin_view->renderPage();
	}

	/**
	 * Register all admin menus
	 */
	public function addMenus(){
		$o = get_option('arv_fb24_opt');

		if (isset($o['submenu']) && $o['submenu']==1){
	      	add_submenu_page('options-general.php','FB Page Promoter Lightbox', 'Arevico Settings', 'manage_options', 'arvlb-tld', array($this,'renderPage'));
		} else{
	      	add_menu_page('FB Page Promoter Lightbox', 'Arevico Settings', 'manage_options', 'arvlb-tld', array($this,'renderPage'));
	      }
	}
	/**
	* Add an link to the options page in the plugin overview
	* @param array $links current links associated with the plugin
	*/
	public function add_settings_link($links) { 
  		$settings_link = '<a href="options-general.php?page=arvlb-tld">Settings</a>'; 
  		array_unshift($links, $settings_link); 
 	 	return $links; 
	}
 
}