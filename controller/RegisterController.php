<?php
/**
 * Espacio de Nombre para todos los controladores
*/
namespace Controller;

/**
 * Añadimos a el espacio de nombre Controller
 * PDO y PDOException para poder hacer uso de ellos
*/
use PDO;
use PDOException;

/**
 * Maneja todas las acciones de Registro
 * 
 * Clase que permite gestionar todas las acciones del registro,
 * validar los datos de entrada, registrarse, etc
 */
class RegisterController {
    private const SALT =  "my_secret_hash_password";
    const REGISTER_KEYS = ["dni","name","surname", "email", "phone", "age", "password"];

    /**
     * Crea el usuario Administrador en la BD
     * 
     * Función que crea el usuario administrador en 
     * la BD, comprobando si el usuario existe
     *  
     * @global $_ENV
     * @throws PDOException si el usuario existe
     * @return mixed 
     */
    public static function registerAdmin() {

        try {
            $connection = ConfigController::getDbConnection();
            [
                "ADMIN_DNI" => $dni,
                "ADMIN_NAME" => $name,
                "ADMIN_SURNAME" => $surname,
                "ADMIN_EMAIL" => $email,
                "ADMIN_PHONE" => $phone,
                "ADMIN_AGE" => $age,
                "ADMIN_PASS" => $pass,
            ] = $_ENV;

            if(!UserController::exist($dni)) {
                $hash_password = password_hash($pass, PASSWORD_BCRYPT, ["salt" => self::SALT, "cost" => 12]);

                $user = [
                    "dni" => $dni,
                    "name" => $name,
                    "surname" => $surname,
                    "email" => $email,
                    "phone" => $phone,
                    "age" => intval($age),
                    "password" => $hash_password,
                ];
    
                $sql_query = <<< END
                    INSERT INTO User (dni, name, surname, email, phone, age, password, is_admin) VALUES 
                    (:dni, :name, :surname, :email, :phone, :age, :password, :is_admin)
                END;
    
                $sentence = $connection->prepare($sql_query);
    
                foreach($user as $key => $field) {
                    $type = $key === "age" ? PDO::PARAM_INT : PDO::PARAM_STR;
    
                    $sentence->bindValue(":$key", $field, $type);
                }
    
                $sentence->bindValue(":is_admin", true, PDO::PARAM_BOOL);
                $sentence->execute();
            }
            
        } catch (PDOException $error) {
            
            return GeneralController::createErrors($error->getMessage());
        }
    }

    /**
     * Crea un usuario en la BD
     * 
     * Función que crea un usuario en 
     * la BD, comprobando si el usuario existe
     *  
     * @global $_POST
     * @throws PDOException si el usuario existe
     * @param string $dni del usuario
     * @return mixed 
     */
    private static function register() {

        try {
            $connection = ConfigController::getDbConnection();

            [
                $sanitize_dni, 
                $sanitize_name, 
                $sanitize_surname, 
                $sanitize_email, 
                $sanitize_phone, 
                $sanitize_age, 
                $sanitize_password
            ] = GeneralController::sanitizeFields($_POST["user"]);

            if(UserController::exist($sanitize_dni)) {
                throw new PDOException("El usuario ya existe");
            }

            $hash_password = password_hash($sanitize_password, PASSWORD_BCRYPT, ["salt" => self::SALT, "cost" => 12]);

            $user = [
                "dni" => $sanitize_dni,
                "name" => $sanitize_name,
                "surname" => $sanitize_surname,
                "email" => $sanitize_email,
                "phone" => $sanitize_phone,
                "age" => intval($sanitize_age),
                "password" => $hash_password
            ];

            $sql_query = <<< END
                INSERT INTO User (dni, name, surname, email, phone, age, password) VALUES 
                (:dni, :name, :surname, :email, :phone, :age, :password)
            END;

            $sentence = $connection->prepare($sql_query);

            foreach($user as $key => $field) {
                $type = $key === "age" ? PDO::PARAM_INT : PDO::PARAM_STR;

                $sentence->bindValue(":$key", $field, $type);
            }

            $sentence->execute();

            $_SESSION["userId"] = $sanitize_dni;
            
            GeneralController::redirect("../index.php");
        } catch (PDOException $error) {
            
            return GeneralController::createErrors($error->getMessage());
        }
    }

    /**
     * Gestión de Registro del usuario
     * 
     * Función que comprueba los errores y realiza la acción de registro
     * 
     * @global $_POST
     * @return mixed
     */
    public static function registerAction () {
        $is_ok = GeneralController::comprobeFields($_POST["user"], self::REGISTER_KEYS);
        $message = $is_ok 
            ? GeneralController::createErrors("Existen campos vacíos o campos de más", true) 
            : UserController::validateUserForm();

        if(empty($message) && !$is_ok ) {
            $message = self::register();
        } else if(!empty($message) && !$is_ok) {
            $message = GeneralController::createErrors($message);
        }

        return $message;
    }
}