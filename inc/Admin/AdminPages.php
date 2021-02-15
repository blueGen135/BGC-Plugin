<?php


namespace Inc\Admin;


class AdminPages
{
    function add_admin_pages(){
        add_menu_page('BGC Plugin','BGC','manage_options','bgc_plugin', array($this,'admin_index'),'dashicons-store',110 );
    }
}