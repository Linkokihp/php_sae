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
                    $this->setUserId($data['UserId']);
                    $this->setUserName($data['UserName']);
                    $this->setUserPassword($data['UserPassword']);
                    $this->setUserMail($data['UserMail']);
                    header("Location:gameengine/app.php");
                    return true;
                }
            }
        }

        // escape value from form
        public function esc(String $value) {
            // bring the global db connect object into function
            include "config.php";

            $val = trim($value); // remove empty space sorrounding string
            $val = mysqli_real_escape_string($conn, $value);

            return $val;
        }
    }


    class chat{
        private $ChatId, $ChatUserId, $ChatText;

        //GET/SET ChatId
        public function getChatId(){
            return $this->ChatId;
        }
        public function setChatId($ChatId){
            $this->ChatId = $ChatId;
        }

        //GET/SET ChatUserId
        public function getChatUserId(){
            return $this->ChatUserId;
        }
        public function setChatUserId($ChatUserId){
            $this->ChatUserId = $ChatUserId;
        }

        //GET/SET ChatText
        public function getChatText(){
            return $this->ChatText;
        }
        public function setChatText($ChatText){
            $this->ChatText = $ChatText;
        }

        //Insert ChatMessage
        public function insertChatMessage(){
            include 'config.php';
            $req=$bdd->prepare("INSERT INTO chat(ChatUserId, ChatText) VALUES (:ChatUserId, :ChatText)");

            //Execute Data
            $req->execute(array(
                'ChatUserId'=>$this->getChatUserId(),
                'ChatText'=>$this->getChatText()
            ));
        }
        
        //Display ChatMessage
        public function displayChatMessage(){
            include 'config.php';
            $ChatReq=$bdd->prepare("SELECT * FROM chat ORDER BY ChatId");
            $ChatReq->execute();

            while($DataChat = $ChatReq->fetch()){
                $UserReq=$bdd->prepare("SELECT * FROM users WHERE UserId=:UserId");
                //Execute Data
                $UserReq->execute(array(
                    'UserId' => $DataChat['ChatUserId']
                ));
                $DataUser = $UserReq->fetch();
                ?>
                    <!-- start speech bubble -->
                    <div id="speech-bubble">
                        <div id="bub-part-a"></div>
                        <div id="speech-txt" class="chatMessages userMessages"><?php echo htmlspecialchars($DataChat['ChatText']);?></div>
                        <div id="bub-part-a"></div>

                        <div id="speech-arrow">
                            <div id="arrow-w"></div>
                            <div id="arrow-x"></div>
                            <div id="arrow-y"></div>
                            <div id="arrow-z"></div>
                        </div>
                    </div>
                    <!--end speech bubble-->
                <?php
            }
        }

        //Delete ChatMessage
        public function deleteChatMessage(){
            include 'config.php';
            $req=$bdd->prepare("DELETE FROM chat WHERE ChatUserId=ChatUserId");

            //Execute Data
            $req->execute(array(
                'ChatUserId'=>$this->getChatUserId(),
            ));
        }
    }

?>