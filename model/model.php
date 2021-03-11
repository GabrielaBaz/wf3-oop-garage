<?php

require('Car.php');

function dbConnect()
{
    $db = new PDO('mysql:host=localhost;dbname=garage;charset=utf8', 'root', 'root');

    return $db;
}


function addCar(Car $car)
{
    $db = dbConnect();

    $success = NULL;

    // Requête SQL
    $sql = "INSERT INTO cars(name, brand, price, description, photo) ";
    $sql .= "VALUES(:name, :brand, :price, :description, :photo)";

    // Requête préparée
    $result = $db->prepare($sql);
    return $result->execute(array('name' => $car->getName(), 'brand' => $car->getBrand(), 'price' => $car->getPrice(), 'photo' => $car->getPhoto(), 'description' => $car->getDescription()));
}


function listCars()
{
    $db = dbConnect();

    $sql = 'SELECT * FROM cars';
    $result = $db->query($sql);
    $cars = array();

    while ($row = $result->fetch()) {
        $cars[] = new Car($row);
    }

    return $cars;
}


function getCarDetail(Car $car)
{
    $db = dbConnect();

    if (checkCarId($car)) {
        $sql = 'SELECT * FROM cars WHERE car_id=:id';
        $result = $db->prepare($sql);
        if ($result->execute(array('id' => $car->getCarId()))) {
            $row = $result->fetch();
            $car->setName($row['name']);
            $car->setBrand($row['brand']);
            $car->setPrice($row['price']);
            $car->setPhoto($row['photo']);
            $car->setDescription($row['description']);
            return $car;
        } else {
            throw new Exception('Error getting the car details.');
        }
    } else {
        throw new Exception('The car ID does not exist.');
    }
}


function checkCarId(Car $car)
{

    $db = dbConnect();
    $sql = 'SELECT COUNT(*) as num_row FROM cars WHERE car_id=:id';
    $result = $db->prepare($sql);
    $result->execute(array('id' => $car->getCarId()));
    $row = $result->fetch();

    return $row['num_row'] > 0;
}


function deleteCarRow(Car $car)
{
    $db = dbConnect();

    if (checkCarId($car)) {
        $sql = 'DELETE FROM cars WHERE car_id=:id';
        $result = $db->prepare($sql);
        $reply = $result->execute(array('id' => $car->getCarId()));
    } else {
        throw new Exception('The car ID does not exist.');
    }

    return $reply;
}

function userConnect(User $user)
{
    $db = dbConnect();

    if (checkUserId($user)) {
        $sql = 'SELECT * FROM users WHERE user_id=:id';
        $reply = $db->prepare($sql);
        $reply->execute(array('id' => $user->getUserId()));
        $row = $reply->fetch();
        return $row;
    }
}

function checkUserId(User $user)
{
    $db = dbConnect();

    $sql = 'SELECT COUNT(*) as num_row FROM users WHERE user_id=:id';
    $reply = $db->prepare($sql);
    $reply->execute(array('id' => $user->getUserId()));
    $row = $reply->fetch();

    return $row['num_row'] > 0;
}
