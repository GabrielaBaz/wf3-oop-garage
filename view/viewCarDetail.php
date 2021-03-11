<?php $title = 'Car Detail';

$defaultPhoto = 'https://images.unsplash.com/photo-1441864452027-8d5ba1dccb84?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=800&q=80';

?>

<?php ob_start() ?>

<div class="container">
    <div class="card">

        <img src="<?= $car->getPhoto() ?? $defaultPhoto ?>" class="card-img-top" alt="Une jolie photo de cars">

        <div class="card-body">
            <h5 class="card-title"><?= $car->getName() ?></h5>
            <p>brand : <?= $car->getBrand() ?></p>
            <p>price : <?= $car->getPrice() ?></p>
            <p class="card-text"><?= $car->getDescription() ?></p>
        </div>
    </div>
</div>

<?php $content = ob_get_clean() ?>

<?php require('view/template.php');
