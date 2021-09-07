<?php

    class user{
        private $UserId, $UserName, $UserMail, $UserPassword, $UserNinja;

        //GET/SET UserId
        public function getUserId() {
            return $this->UserId;
        }
        public function setUserId($UserId) {
            $this->UserId=$UserId;
        }

        //GET/SET UserName
        public function getUserName() {
            return $this->UserName;
        }
        public function setUserName($UserName) {
            $this->UserName=$UserName;
        }

        //GET/SET UserMail
        public function getUserMail() {
            return $this->UserMail;
        }
        public function setUserMail($UserMail) {
            $this->UserMail=$UserMail;
        }

        //GET/SET UserPassword
        public function getUserPassword() {
            return $this->UserPassword;
        }
        public function setUserPassword($UserPassword) {
            $this->UserPassword=$UserPassword;
        }

        //GET/SET UserNinja
        public function getUserNinja() {
            return $this->UserNinja;
        }
        public function setUserNinja($UserNinja) {
            $this->UserNinja=$UserNinja;
        }

        //Insert user into db
        public function insertUser() {
            include "config.php";
            $req=$bdd->prepare("INSERT INTO users(UserName,UserMail,UserPassword) VALUES(:UserName, :UserMail, :UserPassword)");

            //Execute Data
            $req->execute(array(
                'UserName'=>$this->getUserName(),
                'UserMail'=>$this->getUserMail(),
                'UserPassword'=>$this->getUserPassword()
                //'UserNinja'=>$this->getUserNinja()
            ));
        }

        //User Login
        public function userLogin() {
            include "config.php";
            $req=$bdd->prepare("SELECT * FROM users WHERE UserMail=:UserMail AND UserPassword=:UserPassword");

            //Execute Data
            $req->execute(array(
                'UserMail'=>$this->getUserMail(),
                'UserPassword'=>$this->getUserPassword()
            ));

            if($req->rowCount()==0) {
                header("Location:index.php?error=1");
                return false;
            } else {
                while($data=$req->fetch()){
                    $this->setUserId($data(['UserId']));
                    $this->setUserName($data(['UserName']));
                    $this->setUserPassword($data(['UserPassword']));
                    $this->setUserMail($data(['UserMail']));
                    header("Location:home.php");
                    return true;
                }
            }
        }
    }

?>