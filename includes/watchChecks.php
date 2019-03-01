<?php

/**
 * @package settingNotify
 * @version 1.0.0
 */

 // Watches checks and sends notifications when an update occurs


class watchChecks
{
    public $checks;

    function register_checks() {
        // Call to database to get all checks and add them to the array

    }

    function updated_option( $option_name, $old_value, $new_value ) {
        foreach ($checks as $check) {
            if ( $option_name === $check ) {
                if ( $new_value !== $old_value  ) {
                    // Value has changed, run code here.
                    echo "$this->option_name has been changed from $this->old_value to $this->new_value";
                }
            }
        }
    }
}
 