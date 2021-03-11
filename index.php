<?php
require('controller/controller.php');



try {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'insert':
                insert();
                break;
            case 'carList':
                showAllCars();
                break;
            case 'carDetail':
                carDetail();
                break;
            case 'deleteCar':
                deleteCar();
                break;
            default:
                insert();
        }
    } else {
        insert();
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
