<?php 

class Payment{
     private $id;
     private $creditCardNumber;
     private $creditCardExpiry;
     private $creditCardName;
     private $creditCardType;
     private $bankIssued;

    public function __construct($parameters = array()){
        foreach($parameters as $key => $value){
            $this->$key = $value;
        }
    }

    public function getPaymentId()
    {
        return $this->id;
    }

    public function setPaymentId($id)
    {
        $this->$id = $id;
    }

    public function getCreditCardNumber()
    {
        return $this->creditCardNumber;
    }

    public function setCreditCardNumber($creditCardNumber)
    {
        $this->$creditCardNumber = $creditCardNumber;
    }
    public function getCreditCardExpiry()
    {
        return $this->creditCardExpiry;
    }

    public function setCreditCardExpiry($creditCardExpiry)
    {
        $this->$creditCardExpiry = $creditCardExpiry;
    }
    public function getCreditCardName()
    {
        return $this->creditCardName;
    }

    public function setCreditCardName($creditCardName)
    {
        $this->$creditCardName = $creditCardName;
    }
    public function getCreditCardType()
    {
        return $this->creditCardType;
    }

    public function setCreditCardType($creditCardType)
    {
        $this->$creditCardType = $creditCardType;
    }
    public function getBankIssued()
    {
        return $this->bankIssued;
    }

    public function setBankIssued($bankIssued)
    {
        $this->$bankIssued = $bankIssued;
    }
    
}

?>