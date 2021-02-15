<?php
/**
 * @package  bgcPlugin
 */
namespace Inc;

final class Init
{
	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 */
	public static function get_services() 
	{
		return [
			Pages\Admin::class,
			Base\Enqueue::class
		];
	}

	/**
	 * Loop through the classes, initialize them, 
	 * and call the register() method if it exists
	 * @return
	 */
	public static function register_services() 
	{
		foreach ( self::get_services() as $class ) {
			$service = self::instantiate( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	/**
	 * Initialize the class
	 * @param  class $class    class from the services array
	 * @return class instance  new instance of the class
	 */
	private static function instantiate( $class )
	{
		$service = new $class();

		return $service;
	}
}

//use Inc\Activate;
//use Inc\Deactivate;
//use Inc\Admin\AdminPages;
//class BGCPlugin{
//
//    public $plugin;
//
//    function __construct(){
//        $this->plugin = plugin_basename(__FILE__);
//    }
//
//    function register(){
//       add_action('admin_enqueue_scripts', array($this, 'enqueue'));
//       add_action('admin_menu',array($this, 'add_admin_pages'));
//       add_filter("plugin_action_links_$this->plugin",array($this,'setting_link'));
//    }
//
//    function setting_link($links){
//        $settings_link = '<a href="admin.php?page=bgc_plugin">Settings</a>';
//        array_push($links,$settings_link);
//        return $links;
//    }
//
//
//    function admin_index(){
//        require_once plugin_dir_path(__FILE__).'templates/admin.index.php';
//    }
//
//    protected function create_post_type() {
//        add_action( 'init', array( $this, 'custom_post_type' ) );
//    }
//
//    function custom_post_type(){
//        $args = array(
//            'labels' => array (
//                'name' => __( 'Books', 'books' ),
//                'singular_name' => __( 'Book', 'book' ),
//            ),
//            'description' => 'Add book with their details.',
//            'supports' => array( 'title', 'editor', 'thumbnail', ),
//            'taxonomies' => array( 'book' ),
//            'public' => true,
//            'menu_position' => 50,
//            'menu_icon' => 'dashicons-images-alt2',
//            'has_archive' => true,
//            'capability_type' => 'post',
//            'rewrite' => array('slug' => 'book', ),
//        );
//
//        register_post_type( 'books', $args );
//    }
//
//    function activate() {
//        Activate::activate();
//    }
//
//    function enqueue(){
//      wp_enqueue_style('bgcpluginstyle',plugin_dir_url(__FILE__).'assets/mainstyle.css');
//      wp_enqueue_script('bgcpluginjs',plugin_dir_url(__FILE__).'assets/mainjs.js');
//    }
//
//}
//
//$bgcObj = new BGCPlugin();
//$bgcObj->register();
////Activate

//register_activation_hook('__FILE__', array($bgcObj,'activate'));
////Deactivate
//register_deactivation_hook('__FILE__', array('Deactivate','deactivate'));
