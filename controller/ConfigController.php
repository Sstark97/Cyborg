<?php
/**
 * Espacio de Nombre para todos los controladores
 */
namespace Controller;

/**
 * Añadimos a el espacio de nombre Controller
 * PDO y Dotenv para poder hacer uso de ellos
 */
use PDO;
use Dotenv;

/**
 * Cargamos las variables de entorno usando la 
 * librería Dotenv
*/
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "\..");
$dotenv->safeLoad();

/**
 * Maneja la Configuración de la BD
 * 
 * Clase que maneja la configuración de la BD,
 * devolviendo su configuración y su instancia
*/
class ConfigController {
    /**
     * Conexión a la BD
     * 
     * Función que devuelve los parámetros de conexión
     * a la base de datos
     * 
     * @global $_ENV
     * @return array asociativo con las opciones de conexión
     */
    public static function getDbConfig() {
        
        return [
            'db' => [
                'host' => $_ENV["DB_HOST"],
                'user' => $_ENV["DB_USER"],
                'pass' => $_ENV["DB_PASS"],
                'name' => $_ENV["DB_NAME"],
                'options' => [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ],
            ],
        ];
    }

    /**
     * Conexión con la BD
     *
     * Función que devuelve la conexión a la BD en base a 
     * las configuraciones definidas en el fichero ./config/config.php.
     * Los posibles fallos a la hora de crear la conexión
     * están controlados en las funciones que interactúan con
     * la BD
     *
     * @return PDO conexión a la BD
     */
    public static function getDbConnection()
    {
        $config = self::getDbConfig();
        [
            "host" => $host,
            "user" => $user,
            "pass" => $pass,
            "name" => $name,
            "options" => $options,
        ] = $config["db"];

        $connection = new PDO("mysql:host=$host;dbname=$name", $user, $pass, $options);

        return $connection;
    }

}