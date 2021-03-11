<?php

require('model/model.php');

const DIR = 'public/images/';

function insert()
{

    $success = NULL;

    if (
        isset($_POST["name"]) && isset($_POST["brand"]) && isset($_POST["price"]) && isset($_POST['description'])
        && $_POST["name"] != "" && $_POST["brand"] != "" && $_POST["price"] != ""
    ) {

        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
            $photo = uploadPhoto($_FILES['photo']);
        } else {
            $photo = NULL;
        }

        if ($_POST['description'] == '') {
            $description = NULL;
        } else {
            $description = $_POST['description'];
        }

        $car = new Car(array(
            'car_id' => 0, 'name' => $_POST["name"], 'brand' => $_POST["brand"],
            'price' => $_POST["price"], 'photo' => $photo, 'description' => $description
        ));


        if (addCar($car)) {
            $success = 1;
        } else {
            throw new Exception('Car insert has failed.');
        }
    }

    require('view/viewInsert.php');
}


function uploadPhoto(array $photo_array)
{

    if (isset($photo_array) and $photo_array['error'] == 0) {
        //On récupère les informations sur le name du fichier qui a été envoyé : name entier du fichier, extension, name du fichier sans extention
        $infosfichier = pathinfo($photo_array['name']);
        $extension_upload = strtolower($infosfichier['extension']);
        $name_image = $infosfichier['filename'];
        $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');

        //On vérifie si l'extension du fichier envoyé est bien dans mon tableau d'extensions autorisées
        if (in_array($extension_upload, $extensions_autorisees)) {

            // Testons si le fichier n'est pas trop gros
            if ($photo_array['size'] <= 1000000) {
                $photo = DIR . $name_image . '_' . time() . '.' . $extension_upload;
                //emplacement temporaire du fichier envoyé
                $temp = $photo_array['tmp_name'];

                //Création du dossier images si il n'existe pas
                if (!is_dir(DIR)) {
                    mkdir(DIR, 0755, true);
                }

                //déplace moi le fichier temporaire dans mon dossier images
                move_uploaded_file($temp, $photo);
                return $photo;
            }
        }
    }
}


function showAllCars()
{
    $allCars = listCars();

    require('view/viewCarList.php');
}


function carDetail()
{
    if (isset($_GET['id'])) {
        $car = new Car(array(
            'car_id' => $_GET['id'], 'name' => 'empty', 'brand' => 'empty',
            'price' => 0.1, 'photo' => 'empty', 'description' => 'empty'
        ));
        $car = getCarDetail($car);
    } else {
        header('Location: index.php');
    }

    require('view/viewCarDetail.php');
}

function deleteCar()
{
    if (isset($_GET['car_id'])) {

        $car = new Car(array(
            'car_id' => $_GET['car_id'], 'name' => 'empty', 'brand' => 'empty',
            'price' => 0.1, 'photo' => 'empty', 'description' => 'empty'
        ));

        $car = getCarDetail($car);

        //If photo is not null then delete it
        if ($car->getPhoto()) {
            unlink($car->getPhoto());
        }

        if (deleteCarRow($car)) {
            $delete = 1;
            header('Location: index.php?action=carList');
        } else {
            throw new Exception('Something wrong deleting the car.');
        }
    } else {
        throw new Exception('Problem passing the parameter through GET.');
    }

    //require('view/viewCarList.php');
}

function userLogin()
{
    if (isset($_POST['userId']) && isset($_POST['userPassword'])) {
        $user = new User(array('userId' => $_POST['userId'], 'password' => $_POST['userPassword']));
        $user = userConnect($user);
    }
}
