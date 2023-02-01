<?php
/**
 * Espacio de Nombre para todos los controladores
 */
namespace Controller;

/**
 * Maneja la autenticación
 * 
 * Clase que maneja las diferentes acciones de autenticación,
 * como son el controlar si un usuario es administrador,
 * comprobar si un usuario está o no logueado y hacer logout.
 */
class AuthController {
    /**
     * Control de administrador 
     * 
     * Control para evitar que entren en esta página 
     * usuarios que no estén logueados como admin
     * 
     * @global $_SESSION
     * @return void
    */
    public static function isAdmin () {
        if (!isset($_SESSION["userId"]) || isset($_SESSION["userId"]) && !$_SESSION["is_admin"]) {
            GeneralController::redirect("../index.php");
        }
    }

    /**
     * Control de usuario 
     * 
     * Control para evitar que entren en esta página 
     * usuarios que estén logueados como admin
     * 
     * @global $_SESSION
     * @return void
    */
    public static function isNotAdmin () {
        if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"]) {
            GeneralController::redirect("../index.php");
        }
    }

    /**
     * Comprueba si el usuario está logueado
     * 
     * Función que te redirige a inicio en
     * caso de que el id del usuario se
     * encuentre en la sesión
     * 
     * @global $_SESSION
     * @return void
     */
    public static function isLogged () {
        if (isset($_SESSION["userId"])) {
            GeneralController::redirect("../index.php");
        }
    }

    /**
     * Cerrar sesión
     * 
     * Función que destruye la sesión y te redirige
     * al login
     * 
     *@return void
    */
    public static function logout () {
        session_destroy();

        GeneralController::redirect("./pages/login.php");
    }

    /**
     * Redirecciona al login a usuarios sin loguear
     * 
     * Función que te redirige al login en
     * caso de que el id del usuario no
     * se encuentre en la sesión
     * 
     * @global $_SESSION
     * @return void
     */
    public static function isNotLogged () {
        if (!isset($_SESSION["userId"])) {
            GeneralController::redirect("./pages/login.php");
        }
    }
}