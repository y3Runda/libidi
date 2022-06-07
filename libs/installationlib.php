<?php

function database_connect($host, $name, $user, $pass) {
    try {
        $connection = new PDO("mysql:host=$host;dbname=$name", $user, $pass);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $errors[] = 'Connection to database failed: ' . $e->getMessage();
        return null;
    }
    return $connection;
}

function database_close_connection_null() {
    return null;
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

// TODO: Full list of tables
function create_all_tables($prefix, $connection) {
    $sql_accounts = "CREATE TABLE ${prefix}accounts ( 
        id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY , 
        username VARCHAR(255) NOT NULL , 
        email VARCHAR(255) NOT NULL , 
        password VARCHAR(255) NOT NULL , 
        first_name VARCHAR(255) NOT NULL , 
        surname VARCHAR(255) NOT NULL , 
        joining_date DATE NOT NULL ,
        role VARCHAR(255) NOT NULL , 
        status INT NOT NULL , 
        token VARCHAR(255) NOT NULL
        ) ENGINE = InnoDB;";
    $sql_books = "CREATE TABLE ${prefix}books ( 
        id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY , 
        isbn VARCHAR(255) NOT NULL , 
        title VARCHAR(255) NOT NULL , 
        author_id INT(11) NOT NULL , 
        writing_year VARCHAR(5) NOT NULL , 
        publisher VARCHAR(255) NOT NULL , 
        amount INT NOT NULL
        ) ENGINE = InnoDB;";
    $connection->exec($sql_accounts);
    $connection->exec($sql_books);
}