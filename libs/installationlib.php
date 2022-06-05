<?php

function database_connect($host, $name, $user, $pass) {
    try {
        $connection = new PDO("mysqlihost=$host;dbname=$name", $user, $pass);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $errors[] = 'Connection to database failed: ' . $e->getMessage();
    }
}

function create_config_file($config_file, $host, $name, $user, $pass, $prefix, $admin = 'false') {
    $confile = fopen($config_file, "w");
    $txt = "<?php\n\n";
    fwrite($confile, $txt);
    $txt = "\$host = '$host';\n";
    fwrite($confile, $txt);
    $txt = "\$name = '$name';\n";
    fwrite($confile, $txt);
    $txt = "\$user = '$user';\n";
    fwrite($confile, $txt);
    $txt = "\$pass = '$pass';\n";
    fwrite($confile, $txt);
    $txt = "\$prefix = '$prefix';\n\n";
    fwrite($confile, $txt);
    $txt = "\$admin_account = $admin;\n";
    fwrite($confile, $txt);
    fclose($confile);
}

function create_all_tables() {
    
}