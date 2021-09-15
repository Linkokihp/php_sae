<?php
    include "classes.php";
    $user = new user();

    if(isset($_POST['UserName']) && isset($_POST['UserMail']) && isset($_POST['UserPassword']) /*&& isset($_POST['UserNinja'])*/) {
        $user->setUserName($_POST['UserName']);
        $user->setUserMail($_POST['UserMail']);
        $user->setUserPassword(sha1($_POST['UserPassword']));
        //$user->setUserPassword(password_hash($_POST['UserPassword'],PASSWORD_DEFAULT));
        //$user->setUserNinja($_POST['UserNinja']);
        $user->insertUser();

        header("Location:index.php?success=1");
    }
?>