<?php
session_start();
if ($_POST["email"]=="admin@gmail.com") {
    if ($_POST["passwd"]=="admin") {
        $_SESSION["lock"] = "qwertyuio76529t9b8ny7KH*&TVOU^V%^JKUV%T#";
        header("Location: /admin/home.php");
        die();
    } else {
        header("Location: /admin/?err=username or password is incorrect!");
        die();
    }
} else {
    header("Location: /admin/?err=username or password is incorrect!");
    die();
}
?>