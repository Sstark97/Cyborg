<?php
require "vendor/autoload.php";

use Controller\ConfigController;
use Controller\RegisterController;

$config = ConfigController::getDbConfig();

try {
    [
        "host" => $host,
        "user" => $user,
        "pass" => $pass,
        "options" => $options
    ] = $config["db"];

    /**
     * Uso root porque en mi casa me daba fallo al crear
     * la base de datos, para lo demás uso la configuración
     * de mi usuario
     */
    $connection = new PDO("mysql:host=$host", $user, $pass, $options);
    $sql = file_get_contents('data/bbdd.sql');
    $connection->exec($sql);
    RegisterController::registerAdmin();
    echo "The DataBase and all Table created success";
} catch (PDOException $error) {
    echo $error->getMessage();
}
