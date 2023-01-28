<?php
    require_once "../vendor/autoload.php";

    use Controller\AuthController;
    use Controller\WhishListController;
    use Controller\UserController;

    session_name("videogames");
    session_start();

    AuthController::isNotLogged();

    /**
     * Determinamos a que nivel dentro del árbol de 
     * directorios nos encontramos, para definir correctamente
     * el path para los ficheros requeridos
     */
    $path = strpos($_SERVER["PHP_SELF"], "pages") !== false ? "../" : "";

    $whish_list = WhishListController::get() ?? [];
    $is_admin = isset($_SESSION["is_admin"]) ? $_SESSION["is_admin"] : 0;
?>

<?php include "../partials/header.php" ?>

<?php if(isset($_POST["deleteUser"]) || isset($_POST["updateUser"])): ?>
  <?= UserController::profileAction() ?>
<?php endif; ?>
<!-- ***** Banner Start ***** -->
<div class="row">
  <div class="col-lg-12">
    <!-- Componente con los datos del Perfil -->
    <?php include "../partials/mainProfile.php" ?>
  </div>
</div>
<!-- ***** Banner End ***** -->

<!-- ***** Gaming Library Start ***** -->
<?php if(!$is_admin): ?>
  <div class="gaming-library profile-library">
    <div class="col-lg-12">
      <div class="heading-section">
        <h4><em>Tu lista de</em> deseados</h4>
      </div>

      <!-- Renderizamos la lista de deseados -->
      <?php if(count($whish_list) !== 0): ?>
          <?php foreach($whish_list as $game): ?>
              <?= WhishListController::whishListItem ($game) ?>
          <?php endforeach; ?>
      <?php else: ?>
          <h2 class="text-center pb-5">No hay nada en la lista de Deseados</h2>
      <?php endif; ?>
    </div>
  </div>
<?php endif; ?>
<?php include "../partials/footer.php" ?>
