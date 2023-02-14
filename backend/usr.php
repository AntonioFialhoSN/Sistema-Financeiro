<?php
include_once "conn.php";

$query = "SELECT COUNT(*) FROM `users`;";
$result = $conn->prepare($query);
$result->execute();
if(isset($result)){
    $row_usuario =  $result->fetch(PDO::FETCH_ASSOC);
    $retorna = ['erro'=> false, 'msg' => $row_usuario];

}else{
    $retorna = ['erro'=> true, 'msg' => "Erro: Dados não acessados!"];
    }

echo json_encode($retorna);

?>