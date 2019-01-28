<?php

try {

$db = new PDO("mysql:host=db767806095.hosting-data.io;dbname=db767806095", "dbo767806095", "edouard78");
}

catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

?>