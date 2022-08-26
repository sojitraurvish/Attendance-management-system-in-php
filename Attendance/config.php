<?php
    class Database
    {
        private $hostname;
        private $username;
        private $password;
        private $database;
        
        public function connection()
        {
            
            $this->hostname="localhost";
            $this->username="urvish";
            $this->password="urvish";
            $this->database="attendance";

            $con=new mysqli($this->hostname,$this->username,$this->password,$this->database);
            
            if($con->connect_error)
            {
                return die("<br> Error:".$con->connect_error);
            }
            else
            {
                return  $con;
            }     
        }
        
    }
?>