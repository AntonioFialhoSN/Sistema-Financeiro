<?php
$dbHost = 'Localhost';
$dbUsername = 'root';
$dbPassword ='';
$dbName ='sistema';
// $conn= new mysqli($dbHost,$dbUsername,$dbPassword, $dbName);
try{
    $conn = new PDO('mysql:host='.$dbHost.';dbname='.$dbName,$dbUsername, $dbPassword);
    //echo "Conexão feita com sucesso";
} catch (PDOException $E){
    $E->getMessage();
}