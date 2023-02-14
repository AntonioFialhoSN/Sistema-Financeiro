<?php
include_once "conn.php";

// $nome= filter_input(INPUT_GET,"nome", FILTER_SANITIZE_NUMBER_INT);
// $acao= filter_input(INPUT_GET,"acao", FILTER_SANITIZE_NUMBER_INT);
// $tempo= filter_input(INPUT_GET,"tempo", FILTER_SANITIZE_NUMBER_INT);
$nome =  $_GET['nome'];
$acao =  $_GET['acao'];
$tempo =   $_GET['tempo'];

if($nome == ''){
    $retorna = ['erro' => true, 'msg' => "Error! Ausencia da variavel nome."];
}elseif(empty($acao)){
    $retorna = ['erro' => true, 'msg' => "Error! Ausencia da variavel ação."];
}elseif(empty($tempo)){
    $retorna = ['erro' => true, 'msg' => "Error! Ausencia da variavel dada."];
}else{
    $query_usuario = "INSERT INTO `log` (`nome`, `acao`, `hora_data`) VALUES (:nome, :acao, :tempo);";
    $stmt = $conn ->prepare($query_usuario);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':acao', $acao);
    $stmt->bindParam(':tempo', $tempo);
    $stmt->execute();
    if(isset($stmt)){
        $retorna = ['erro' => false, 'msg' => "Sucesso no registre!"];
    }else{
        $retorna = ['erro' => true, 'msg' => "Erro ao registrar!"];
    }
}
echo json_encode($retorna);