<?php 

class User{
    private $id;
    private $userName;
    private $password;
    private $isManager;
    public function __construct($parameters = array()){
        foreach($parameters as $key => $value){
            $this->$key = $value;
        }
    }

    public function getUserId()
    {
        return $this->id;
    }

    public function setUserId($id)
    {
        $this->$id = $id;
    }
}


?>