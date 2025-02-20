<?php

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["sign"])) {
    header("Location: register.php");
    exit();
}

$template = "index";

include "layout.phtml";