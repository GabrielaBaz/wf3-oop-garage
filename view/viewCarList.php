<?php $title = 'List of Cars';

$defaultPhoto = 'https://images.unsplash.com/photo-1441864452027-8d5ba1dccb84?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=800&q=80';

function truncateWords($input, $numwords, $padding = "...")
{
    $output = strtok($input, " \n");
    while (--$numwords > 0) $output .= " " . strtok(" \n");
    if ($output != $input) $output .= $padding;
    return $output;
}
?>

<?php ob_start() ?>

<section class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">brand</th>
                <th scope="col">price</th>
                <th scope="col">Photo</th>
                <th scope="col">Description</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($allCars as $key => $car) {  ?>
                <tr>
                    <th><a href="index.php?action=carDetail&amp;id=<?= $car->getCarId() ?>"><?= $key + 1 ?></a></th>
                    <td> <?= $car->getName() ?></td>
                    <td> <?= $car->getBrand() ?></td>
                    <td> <?= $car->getPrice() ?></td>
                    <td> <img class="list-car-img" src="<?= $car->getPhoto() ?? $defaultPhoto ?>" alt="carro"> </td>
                    <td> <?= strlen($car->getDescription()) > 75 ? truncateWords($car->getDescription(), 10) : $car->getDescription() ?></td>
                    <td> <a class="btn btn-danger" href="index.php?action=deleteCar&amp;car_id=<?= $car->getCarId() ?>"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</section>


<?php $content = ob_get_clean() ?>

<?php require('view/template.php') ?>