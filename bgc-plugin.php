<?php
/**
 * @package bgcPlugin
*/
/**
 * Plugin Name:       BGC Plugin
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Wordpress custom post type creator
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Raaj
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       bgc-like-dislike
 * Domain Path:       /languages
 */

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

defined ('ABSPATH') or die('Hey now say cow');

if(file_exists(dirname(__DIR__). '/vendor/autoload.[h[')){
    require_once dirname(__DIR__). '/vendor/autoload.php';
}
use Inc\Activate;
use Inc\Deactivate;
use Inc\Admin\AdminPages;
class BGCPlugin{

    public $plugin;

    function __construct(){
        $this->plugin = plugin_basename(__FILE__);
    }

    function register(){
       add_action('admin_enqueue_scripts', array($this, 'enqueue'));
       add_action('admin_menu',array($this, 'add_admin_pages'));
       add_filter("plugin_action_links_$this->plugin",array($this,'setting_link'));
    }

    function setting_link($links){
        $settings_link = '<a href="admin.php?page=bgc_plugin">Settings</a>';
        array_push($links,$settings_link);
        return $links;
    }


    function admin_index(){
        require_once plugin_dir_path(__FILE__).'templates/admin.index.php';
    }

    protected function create_post_type() {
        add_action( 'init', array( $this, 'custom_post_type' ) );
    }

    function custom_post_type(){
        $args = array(
            'labels' => array (
                'name' => __( 'Books', 'books' ),
                'singular_name' => __( 'Book', 'book' ),
            ),
            'description' => 'Add book with their details.',
            'supports' => array( 'title', 'editor', 'thumbnail', ),
            'taxonomies' => array( 'book' ),
            'public' => true,
            'menu_position' => 50,
            'menu_icon' => 'dashicons-images-alt2',
            'has_archive' => true,
            'capability_type' => 'post',
            'rewrite' => array('slug' => 'book', ),
        );

        register_post_type( 'books', $args );
    }

    function activate() {
        Activate::activate();
    }

    function enqueue(){
      wp_enqueue_style('bgcpluginstyle',plugin_dir_url(__FILE__).'assets/mainstyle.css');
      wp_enqueue_script('bgcpluginjs',plugin_dir_url(__FILE__).'assets/mainjs.js');
    }

}

$bgcObj = new BGCPlugin();
$bgcObj->register();
//Activate

register_activation_hook('__FILE__', array($bgcObj,'activate'));
//Deactivate
register_deactivation_hook('__FILE__', array('Deactivate','deactivate'));
