<?php

function libidi_require_minimum_php_version() {
    libidi_minimum_php_version_is_met(true);
}

/**
 * Tests the current PHP version against Libidi's minimum requirement.
 * When requirement is not met returns false or halts execution depending on $haltexecution param.
 */
function libidi_minimum_php_version_is_met($haltexecution = false) {
    $minimumversion = "7.1.0";
    $requirementchanged = "1.0";

    if (version_compare(PHP_VERSION, $minimumversion) < 0) {
        if ($haltexecution) {
            $error = "Libidi ${requirementchanged} or later requires at least PHP ${minimumversion} "
            . "(currently using version " . PHP_VERSION . ").\n"
            . "Some servers may have multiple PHP versions installed, are you using the correct executable?\n"; 
            echo $error;
            exit(1);
        } else {
            return false;
        }
    }
    return true;
}

// Do not add extra function to this file
// This file must be functioning on all versions of PHP, extra functions belong elsewhere