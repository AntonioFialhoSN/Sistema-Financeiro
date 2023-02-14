<?php
include_once "conn.php";
$mes= filter_input(INPUT_GET,"mes", FILTER_SANITIZE_NUMBER_INT);
$ano= filter_input(INPUT_GET,"ano", FILTER_SANITIZE_NUMBER_INT);

$meses =  $mes + 1;

if ($meses > 9){
    $strmes = $meses; 
}else{
    $strmes = '0'.$meses;
}

$query = "SELECT SUM(valor) FROM `financeiro_entrada` WHERE MONTH(dia_entrada) = $strmes AND YEAR(dia_entrada) = $ano;";
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