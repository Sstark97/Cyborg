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
 * Maneja todas las acciones de la lista de deseados
 * 
 * Clase que permite gestionar todas las acciones de la
 * lista de deseados, todas las acciones del CRUD, la 
 * generación de bloques HTML para cada elemento de la 
 * lista de deseados, etc.
 */
class WhishListController {
    /**
     * Agrega un Videojuego a la lista de deseados
     * 
     * Función que añade un videojuego a la 
     * lista de deseados de un usuario
     * 
     * @global $_SESSION
     * @global $_POST
     * @return mixed
     */
    private static function add () {
        $user_id = $_SESSION["userId"] ?? "";
        $game_id = $_POST["gameId"] ?? "";

        if(!empty($user_id) && !empty($game_id)) {
            try {
                $connection = ConfigController::getDbConnection();

                $sql_query = "INSERT INTO WhishList(dni, gameId) VALUES (:dni, :gameId)";
        
                $sentence = $connection->prepare($sql_query);
                $sentence->bindValue(":dni", $user_id, PDO::PARAM_STR);
                $sentence->bindValue(":gameId", $game_id, PDO::PARAM_INT);
        
                $sentence->execute();

                //Cerramos la conexión
                $connection = null;

            } catch (PDOException $error) {
                return GeneralController::createErrors($error->getMessage());
            }
        }
    }

    /**
     * Elimina un Videojuego de la lista de deseados
     * 
     * Función que elimina un videojuego de la 
     * lista de deseados de un usuario
     * 
     * @global $_SESSION
     * @global $_POST
     * @return mixed
     */
    private static function delete () {
        $user_id = $_SESSION["userId"] ?? "";
        $game_id = $_POST["gameId"] ?? "";

        if(!empty($user_id) && !empty($game_id)) {
            try {
                $connection = ConfigController::getDbConnection();

                $sql_query = "DELETE FROM WhishList WHERE dni = :dni AND gameId = :gameId";
        
                $sentence = $connection->prepare($sql_query);
                $sentence->bindValue(":dni", $user_id, PDO::PARAM_STR);
                $sentence->bindValue(":gameId", $game_id, PDO::PARAM_INT);
        
                $sentence->execute();
                
                //Cerramos la conexión
                $connection = null;

            } catch (PDOException $error) {
                return GeneralController::createErrors($error->getMessage());
            }
        }
    }

    /**
     * Comprueba si un Videojuego está en la lista de deseados
     * 
     * Función que comprueba si un videojuego está en la 
     * lista de deseados de un usuario
     * 
     * @global $_SESSION
     * @param int $id 
     * @return mixed si está o no en la lista o error si lo hubiera
     */
    public static function exist (int $id) {
        $user_id = $_SESSION["userId"] ?? "";

        if(!empty($user_id)) {
            try {
                $connection = ConfigController::getDbConnection();

                $sql_query = "SELECT gameId FROM WhishList WHERE dni = :dni AND gameId = :gameId";
        
                $sentence = $connection->prepare($sql_query);
                $sentence->bindValue(":dni", $user_id, PDO::PARAM_STR);
                $sentence->bindValue(":gameId", $id, PDO::PARAM_INT);
        
                $sentence->execute();

                ["gameId" => $game_id] = $sentence->fetch(PDO::FETCH_ASSOC);

                //Cerramos la conexión
                $connection = null;

                return $game_id == $id;
            } catch (PDOException $error) {
                return GeneralController::createErrors($error->getMessage());
            }
        }
    }

    /**
     * Devuelve la lista de deseado
     * 
     * Función que devuelve la lista de videojuegos 
     * deseados de un usuario
     * 
     * @global $_SESSION 
     * @param int $limit limite de elementos a extraer
     * @return mixed lista de deseados | error si lo hubiera
     */
    public static function get (int $limit = 0) {
        $user_id = $_SESSION["userId"] ?? "";

        if(!empty($user_id)) {
            try {
                $connection = ConfigController::getDbConnection();

                $sql_query = "
                    SELECT * FROM VideoGame 
                    INNER JOIN WhishList
                    ON VideoGame.id = WhishList.gameId 
                    WHERE WhishList.dni = :dni
                ";

                $sql_query .= $limit !== 0 ? "LIMIT $limit" : "";
        
                $sentence = $connection->prepare($sql_query);
                $sentence->bindValue(":dni", $user_id, PDO::PARAM_STR);
        
                $sentence->execute();

                $games_in_whish_list = $sentence->fetchAll(PDO::FETCH_ASSOC);

                //Cerramos la conexión
                $connection = null;

                return $games_in_whish_list;
            } catch (PDOException $error) {
                return GeneralController::createErrors($error->getMessage());
            }
        }
    }

    /**
     * Maneja las acciones sobre la lista de deseados
     * 
     * Función que maneja las acciones sobre la
     * lista de deseados de un usuario
     * 
     * @global $_POST
     * @return void
     */

    public static function whishListAction () {
        $game_id = $_POST["gameId"] ?? "";
        $game_is_in_whish_list = self::exist($game_id);

        if($game_is_in_whish_list) {
            self::delete();
        } else {
            self::add();
        }

        header("Refresh: 0");

    }

    /**
     * Fragmento HTML con los datos de un Videojuego deseado
     * 
     * Función que crea un Card por cada videojuego
     * en la lista de deseados
     * 
     * @param array datos del videojuego
     * @return string Código HTML con los datos del videojuego
     */
    public static function whishListItem (array $game) {
        [
            "name" => $name, 
            "genre" => $genre, 
            "img" => $img, 
            "price" => $price,
            "assesment" => $assesment,
            "release_date" => $release_date
        ] = $game;

        /**
         * Determinamos a que nivel dentro del árbol de 
         * directorios nos encontramos, para definir correctamente
         * el path para los ficheros requeridos
         */
        $path = strpos($_SERVER["PHP_SELF"], "pages") !== false ? "../" : "";

        return <<< END
        <div class="item">
            <ul>
                <li><img src="$path$img" alt="$name" class="templatemo-item"></li>
                <li>
                    <h4>$name</h4><span>$genre</span>
                </li>
                <li>
                    <h4>Fecha de Lanzamiento</h4><span>$release_date</span>
                </li>
                <li>
                    <h4>Valoración</h4><span>$assesment</span>
                </li>
                <li>
                    <h4>Precio</h4><span>$price</span>
                </li>
                <li>
                    <div class="main-border-button"><a href="#">Comprar</a></div>
                </li>
            </ul>
        </div>
        END;
    }
}