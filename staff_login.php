<?php
$username = $_POST["student"];
$password = $_POST["dob"];

if($username=="10"){
    if($password=="2023-01-01"){
        echo("Login ok");
    }else{
        echo("Password Wrong");
    }
}else{
    echo("User name wrong");
}

?>