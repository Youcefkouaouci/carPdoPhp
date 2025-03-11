<?php
require_once("header.php");
require_once("connectDB.php");
session_start();
if (isset($_SESSION["username"])) {
    unset($_SESSION["username"]);
}
header("Location: index.php");
