<?php

// Check if file "config.php" exists
$config_file = "config.php";
if (!file_exists($config_file)) {
    header("Location: /install.php");
}

