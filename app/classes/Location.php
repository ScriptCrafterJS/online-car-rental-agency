<?php 

class Location{
     private $id;
     private $pickupName;
     private $returnName;
     private $city;
     private $telephone;

     private $houseNo;

     private $flatNo;

     private $street;

     private $country;
     

    public function __construct($parameters = array()){
        foreach($parameters as $key => $value){
            $this->$key = $value;
        }
    }

    public function getLocationId()
    {
        return $this->id;
    }

    public function setLocationId($id)
    {
        $this->$id = $id;
    }

    public function getPickupName() {
        return $this->pickupName;
    }

    public function setPickupName($pickupName) {
        $this->pickupName = $pickupName;
    }
    public function getReturnName() {
        return $this->returnName;
    }

    public function setReturnName($returnName) {
        $this->returnName = $returnName;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    public function getHouseNo() {
        return $this->houseNo;
    }

    public function setHouseNo($houseNo) {
        $this->houseNo = $houseNo;
    }

    public function getFlatNo() {
        return $this->flatNo;
    }

    public function setFlatNo($flatNo) {
        $this->flatNo = $flatNo;
    }

    public function getStreet() {
        return $this->street;
    }

    public function setStreet($street) {
        $this->street = $street;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setCountry($country) {
        $this->country = $country;
    }
}

?>