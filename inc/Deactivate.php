<?php
/**
 * @package bgcPlugin
 */

namespace Inc;

class Deactivate{
    public static function activate(){
        flush_rewrite_rules();
    }
}