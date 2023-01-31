<?php
    require_once "vendor/autoload.php";

    use Controller\GameController;
    use Controller\WhishListController;

    $popular_games = !is_string(GameController::getPopulars()) ? GameController::getPopulars() : [];
    $whish_list = !is_string(WhishListController::get(3)) ? WhishListController::get(3) : [];
?> 

<?php if(isset($_POST["wish_list_action"])): ?>
    <?= WhishListController::whishListAction() ?>
<?php endif; ?>

<!-- ***** Banner Start ***** -->
<div class="main-banner">
    <div class="row">
        <div class="col-lg-7">
            <div class="header-text">
                <h6>Bienvenido a Cyborg</h6>
                <h4><em>Busca</em> los videojuegos más populares aquí</h4>
                <div class="main-button">
                    <a href="./pages/browse.php">Busca ahora</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Banner End ***** -->

<!-- ***** Most Popular Start ***** -->
<div class="most-popular">
    <div class="row">
        <div class="col-lg-12">
            <div class="heading-section">
                <h4><em>Los más Populares</em> Ahora</h4>
            </div>
            <div class="row">
            
                <!-- Renderizamos la lista de videojuegos populares -->
                <?php if(count($popular_games) !== 0): ?>
                    <?php foreach($popular_games as $game ): ?>
                        <?= GameController::cardGame($game) ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h2 class="text-center">No hay juegos populares</h2>
                <?php endif; ?>
            
                <div class="col-lg-12">
                    <div class="main-button">
                        <a href="./pages/browse.php">Descubre más</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="gaming-library">
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

    <div class="col-lg-12">
        <div class="main-button">
            <a href="./pages/profile.php">Ver la lista completa</a>
        </div>
    </div>
</div>