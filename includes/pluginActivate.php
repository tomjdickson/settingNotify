<?php

// Plugin Information

/**
 * @package settingNotify
 * @version 1.0.0
 */


 class settingNotifyActivate 
 {
     public static function activate() {
        flush_rewrite_rules();
     }
 }