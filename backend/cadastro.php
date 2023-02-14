<?php
include_once "conn.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT) ;

if(empty($dados['nome'])){
    $retorna = ['erro' => true, 'msg' => "Error! Você precisa escrever seu dois primeiros nomes."];
}elseif(empty($dados['login'])){
    $retorna = ['erro' => true, 'msg' => "Error! Você precisa escrever seu login."];
}elseif(empty($dados['senha'])){
    $retorna = ['erro' => true, 'msg' => "Error! Você precisa digitar uma senha."];
}elseif(empty($dados['con_senha'])){
    $retorna = ['erro' => true, 'msg' => "Error! Você precisa repetir a senha."];
}elseif($dados['senha'] != $dados['con_senha']){
    $retorna = ['erro' => true, 'msg' => "Error! Você digitou senhas diferentes."];
}else{
    $sql = "INSERT INTO users (nome, login, senha, codigo) VALUES (:nome, :login, :senha, '55Ddmd5dxdlq5pih8sm4nx83');";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $dados['nome']);
    $stmt->bindParam(':login', $dados['login']);
    $stmt->bindParam(':senha', $dados['senha']);
    if ($stmt->execute()){
        $retorna = ['erro' => false, 'msg' => "Sucesso no registre, aguarde liberação do ADM!"];
    }else{
        $retorna = ['erro' => true, 'msg' => "Erro ao registrar!"];
    }
};

echo json_encode($retorna);


?>