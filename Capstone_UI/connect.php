<?php
/* CREATE A CONNECTION TO THE SERVER */
    $dsn = 'mysql:host=localhost;dbname=mrober23_phpexample';
    $username = 'mrober23_michael';
    $password = 'password';
try{
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
    echo 'ERROR connecting to database!' . $e->getMessage();
    exit();
}
?>



