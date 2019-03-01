<?php

// Plugin Information

/**
 * @package settingNotify
 * @version 1.0.0
 */


 class settingNotifyDeactivate 
 {
    public static function deactivate() {
        flush_rewrite_rules();
     }
 }