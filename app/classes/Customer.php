<?php 
class Customer{
     private $id;
     private $name;
     private $houseNo;
     private $flatNo;
     private $street;
     private $city;
     private $country;
     private $dateOfBirth;
     private $idNumber;
     private $email;
     private $telephone;
     private $userId;

     private $paymentID;


    public function __construct($parameters = array()){
        foreach($parameters as $key => $value){
            $this->$key = $value;
        }
    }

    public function getCustomerId()
    {
        return $this->id;
    }

    public function setCustomerId($id)
    {
        $this->$id = $id;
    }
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
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

    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function getDateOfBirth() {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth($dateOfBirth) {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getIdNumber() {
        return $this->idNumber;
    }

    public function setIdNumber($idNumber) {
        $this->idNumber = $idNumber;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getPaymentID() {
        return $this->paymentID;
    }

    public function setPaymentID($paymentID) {
        $this->paymentID = $paymentID;
    }
}

?>