<?php 

class Rental{
     private $id;
     private $carID;
     private $customerID;
     private $rentStartDate;
     private $rentEndDate;
     private $locationID;
     private $totalAmount;
     private $specialRequirements;
     private $rentalStatus;
     private $paymentID;
     

    public function __construct($parameters = array()){
        foreach($parameters as $key => $value){
            $this->$key = $value;
        }
    }

    public function getRentalId()
    {
        return $this->id;
    }

    public function setRentalId($id)
    {
        $this->$id = $id;
    }

    public function getCarID() {
        return $this->carID;
    }

    public function setCarID($carID) {
        $this->carID = $carID;
    }

    public function getCustomerID() {
        return $this->customerID;
    }

    public function setCustomerID($customerID) {
        $this->customerID = $customerID;
    }

    public function getRentStartDate() {
        return $this->rentStartDate;
    }

    public function setRentStartDate($rentStartDate) {
        $this->rentStartDate = $rentStartDate;
    }

    public function getRentEndDate() {
        return $this->rentEndDate;
    }

    public function setRentEndDate($rentEndDate) {
        $this->rentEndDate = $rentEndDate;
    }

    public function getLocationID() {
        return $this->locationID;
    }

    public function setLocationID($locationID) {
        $this->locationID = $locationID;
    }

    public function getTotalAmount() {
        return $this->totalAmount;
    }

    public function setTotalAmount($totalAmount) {
        $this->totalAmount = $totalAmount;
    }

    public function getSpecialRequirements() {
        return $this->specialRequirements;
    }

    public function setSpecialRequirements($specialRequirements) {
        $this->specialRequirements = $specialRequirements;
    }

    public function getRentalStatus() {
        return $this->rentalStatus;
    }

    public function setRentalStatus($rentalStatus) {
        $this->rentalStatus = $rentalStatus;
    }

    public function getPaymentID() {
        return $this->paymentID;
    }

    public function setPaymentID($paymentID) {
        $this->paymentID = $paymentID;
    }
}

?>