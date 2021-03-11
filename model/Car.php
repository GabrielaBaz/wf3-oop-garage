<?php

class Car
{

    private int $_carId;
    private string $_name;
    private string $_brand;
    private float $_price;
    private $_photo;
    private $_description;

    public function __construct(array $data)
    {
        $this->_carId = (int) $data['car_id'];
        $this->setName($data['name']);
        $this->setBrand($data['brand']);
        $this->setPrice($data['price']);
        $this->setPhoto($data['photo']);
        $this->setDescription($data['description']);
    }

    /*************** Getters ****************** */
    public function getCarId()
    {
        return $this->_carId;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getBrand()
    {
        return $this->_brand;
    }

    public function getPrice()
    {
        return $this->_price;
    }

    public function getPhoto()
    {
        return $this->_photo;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    /** ******************* Setters ****************** */

    public function setName(string $name)
    {
        if ($name != '') {
            $this->_name = htmlspecialchars($name);
        } else {
            throw new Exception('Car name cannot be empty.');
        }
    }

    public function setBrand(string $brand)
    {
        if ($brand != '') {
            $this->_brand = htmlspecialchars($brand);
        } else {
            throw new Exception('Brand cannot be empty.');
        }
    }

    public function setPrice(float $price)
    {
        if ($price > 0) {
            $this->_price = htmlspecialchars($price);
        } else {
            throw new Exception('Price cannot be empty and must be greater than zero.');
        }
    }

    //Photo and description can be null
    public function setPhoto($photo)
    {
        if ($photo !== '') {
            $this->_photo = isset($photo) ? htmlspecialchars($photo) : $photo;
        } else {
            throw new Exception('Photo can be null but not empty');
        }
    }

    public function setDescription($description)
    {
        if ($description !== '') {
            $this->_description = isset($description) ? htmlspecialchars($description) : $description;
        } else {
            throw new Exception('Description can be null but not empty');
        }
    }
}
