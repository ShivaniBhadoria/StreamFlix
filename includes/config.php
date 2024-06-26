<?php
    ob_start(); //Turns on output buffering; it waits till all php is executed before outputting it to the page.
    session_start();

    date_default_timezone_set("Europe/London");

    try {
        $con = new PDO("mysql:dbname=StreamFlix;host=localhost", "root", '');
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }
    catch (PDOException $e) {
        exit("Connection failed: " . $e->getmessage());
    }

?>