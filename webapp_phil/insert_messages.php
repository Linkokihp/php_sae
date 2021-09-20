<?php
    session_start();
    include 'classes.php';

    if(isset($_POST['chatText'])){
        $chat = new chat();
        $chat->setChatUserId($_SESSION['UserId']);
        $chat->setChatText($_POST['chatText']);
        $chat->insertChatMessage();
    }
?>