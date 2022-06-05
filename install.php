<?php

// Check if file "config.php" exists
$config_file = "config.php";
if (file_exists($config_file)) {
    header("Location: /");
}

// Check PHP version
require(__DIR__."/libs/phpminimumversionlib.php");
libidi_require_minimum_php_version();

$errors = array();
$data = $_POST;
if (!empty($data)) {

    $host = $data['db_host'];
    $name = $data['db_name'];
    $user = $data['db_user'];
    $pass = $data['db_password'];
    $pref = $data['db_prefix'];
    
    require_once(__DIR__."/libs/installationlib.php");
    database_connect($host, $name, $user, $pass);
    if (empty($errors)) {
        create_config_file($config_file, $host, $name, $user, $pass, $pref);
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation | Libidi</title>
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/main.css">
</head>
<body>

    <form method="post" action="/install.php" class="container">
        <h1 class="mt-5 mb-2">Installation</h1>
        <div class="card bg-light mb-3">
            <div class="card-body">
                <h4 class="card-title">Database settings</h4>
                <p class="card-text">The database is where most of the Libidi settings and data are stored and must be configured here.</p>
                <p class="card-text">The database name, username and password are required fields; table prefix is optional.</p>
                <p class="card-text">If the database currently not exist, Libidi will attempt to create a new database with the correct permissions and settings.</p>
            </div>
        </div>
        <?php if (!empty($errors)): ?>
        <div class="card text-white bg-danger mb-3" style="max-width: 20rem;">
            <div class="card-body">
                <p class="card-text"><?php echo $errors[0]; ?></p>
            </div>
        </div>
        <?php endif; ?>
        <div class="row mb-3">
            <div class="col-md-4 text-right">
                <label for="inputHost" class="form-label mb-0">Database host</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="db_host" id="inputHost" requried>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 text-right">
                <label for="inputName" class="form-label mb-0">Database name</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="db_name" id="inputName" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 text-right">
                <label for="inputUser" class="form-label mb-0">Database user</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="db_user" id="inputUser" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 text-right">
                <label for="inputPassword" class="form-label mb-0">Database password</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="db_password" id="inputPassword">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 text-right">
                <label for="inputPrefix" class="form-label mb-0">Database prefix</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="db_prefix" id="inputPrefix" value="lib_">
            </div>
        </div>
        <button type="submit" type="button" class="btn btn-primary">Submit</button>
    </form>
    
</body>
</html>