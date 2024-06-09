<?php 

class Invoice{
     private $id;
     private $invoiceDate;
     private $carID;
     private $customerID;
     private $paymentID;

    public function __construct($parameters = array()){
        foreach($parameters as $key => $value){
            $this->$key = $value;
        }
    }

    public function getInvoiceId()
    {
        return $this->id;
    }

    public function setInvoiceId($id)
    {
        $this->$id = $id;
    }
    public function getInvoiceDate()
    {
        return $this->invoiceDate;
    }

    public function setInvoiceDate($invoiceDate)
    {
        $this->$invoiceDate = $invoiceDate;
    }
    public function getCarID()
    {
        return $this->carID;
    }

    public function setCarID($carID)
    {
        $this->$carID = $carID;
    }
    public function getCustomerID()
    {
        return $this->customerID;
    }

    public function setCustomerID($customerID)
    {
        $this->$customerID = $customerID;
    }
    public function getPaymentID()
    {
        return $this->paymentID;
    }

    public function setPaymentID($paymentID)
    {
        $this->$paymentID = $paymentID;
    }
}

?>