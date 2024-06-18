<?php
class Car
{
    private $id;
    private $model;
    private $make;
    private $type;
    private $registrationYear;
    private $description;
    private $pricePerDay;
    private $peopleCapacity;
    private $suitcasesCapacity;
    private $color;
    private $fuelType;
    private $avgConsumption;
    private $horsePower;
    private $length;
    private $width;
    private $gearType;
    private $status;
    private $photoName;

    public function __construct($parameters = array())
    {
        foreach ($parameters as $key => $value) {
            $this->$key = $value;
        }
    }

    public function displayInTable()
    {;
        $row = <<<REC
         <tr>

         <td><input type="checkbox" value="$this->id" name="chosen_cars[]"></td>
         <td>$this->pricePerDay</td>
         <td>$this->type</td>
         <td>$this->fuelType</td>
         <td><img src="../images/$this->photoName" alt="$this->photoName" width="200" height="100"/></td>
         <td>
         <button type="button"><a href='car_details.php?carID=$this->id'>Rent</a></button>
         </td>
         </tr>
    REC;
        return $row;
    }

    public function managerDisplayInTable()
    {
        $row = <<<REC
         <tr>
         <td>$this->id</td>
         <td>$this->type</td>
         <td>$this->model</td>
         <td>$this->description</td>
         <td><img src="../images/$this->photoName" alt="$this->photoName" width="200" height="100"/></td>
         <td>$this->fuelType</td>
         <td>$this->status</td>
         </tr>
    REC;
        return $row;
    }
    public function getCarId()
    {
        return $this->id;
    }
    public function getModel()
    {
        return $this->model;
    }
    public function getMake()
    {
        return $this->make;
    }
    public function getType()
    {
        return $this->type;
    }
    public function getRegistrationYear()
    {
        return $this->registrationYear;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getPricePerDay()
    {
        return $this->pricePerDay;
    }
    public function getPeopleCapacity()
    {
        return $this->peopleCapacity;
    }
    public function getSuitcasesCapacity()
    {
        return $this->suitcasesCapacity;
    }
    public function getColor()
    {
        return $this->color;
    }
    public function getFuelType()
    {
        return $this->fuelType;
    }
    public function getAvgConsumption()
    {
        return $this->avgConsumption;
    }
    public function getHorsePower()
    {
        return $this->horsePower;
    }
    public function getLength()
    {
        return $this->length;
    }
    public function getWidth()
    {
        return $this->width;
    }
    public function getGearType()
    {
        return $this->gearType;
    }
    public function getCarStatus()
    {
        return $this->status;
    }
    public function setCarId($id)
    {
        $this->$id = $id;
    }
    public function setModel($model)
    {
        $this->$model = $model;
    }
    public function setMake($make)
    {
        $this->$make = $make;
    }
    public function setType($type)
    {
        $this->$type = $type;
    }
    public function setRegistrationYear($registrationYear)
    {
        $this->$registrationYear = $registrationYear;
    }
    public function setDescription($description)
    {
        $this->$description = $description;
    }
    public function setPricePerDay($pricePerDay)
    {
        $this->$pricePerDay = $pricePerDay;
    }
    public function setPeopleCapacity($peopleCapacity)
    {
        $this->$peopleCapacity = $peopleCapacity;
    }
    public function setSuitcasesCapacity($suitcasesCapacity)
    {
        $this->$suitcasesCapacity = $suitcasesCapacity;
    }
    public function setColor($color)
    {
        $this->$color = $color;
    }
    public function setFuelType($fuelType)
    {
        $this->$fuelType = $fuelType;
    }
    public function setAvgConsumption($avgConsumption)
    {
        $this->$avgConsumption = $avgConsumption;
    }
    public function setHorsePower($horsePower)
    {
        $this->$horsePower = $horsePower;
    }
    public function setLength($length)
    {
        $this->$length = $length;
    }
    public function setWidth($width)
    {
        $this->$width = $width;
    }
    public function setGearType($gearType)
    {
        $this->$gearType = $gearType;
    }
    public function setCarStatus($status)
    {
        $this->$status = $status;
    }
}
