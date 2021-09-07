<?php
    session_start();
    include "classes.php";
    
    global $bdd;

    $sql = "SELECT * FROM users WHERE UserName='$UserName'";
			$result = mysqli_query($bdd, $sql);
			$numRows = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);

    if(isset($_POST['UserMailLogin']) && isset($_POST['UserPasswordLogin'])) {
        $user = new user();
        $user->setUserMail($_POST['UserMailLogin']);
        $user->setUserPassword(password_verify($_POST['UserPasswordLogin'],$row['UserPassword']));

        if($user->userLogin()==true) {
            $_SESSION['UserId'] = $user->getUserId();
            $_SESSION['UserName'] = $user->getUserName();
            $_SESSION['UserMail'] = $user->getUserMail();
        }
    }
?>