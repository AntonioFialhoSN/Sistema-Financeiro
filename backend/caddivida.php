<?php
include_once "conn.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT) ;



if(empty($dados['cr_nome'])){
    $retorna = ['erro' => true, 'msg' => "Error! Você precisa escrever o nome."];
}elseif(empty($dados['cr_valor'])){
    $retorna = ['erro' => true, 'msg' => "Error! Você precisa escrever o valor."];
}elseif(empty($dados['cr_data'])){
    $retorna = ['erro' => true, 'msg' => "Error! Você precisa digitar uma dada."];
}else{
    $sql = "INSERT INTO financeiro_saida (nome, valor, dia_vencimento) VALUES (:nome, :valor, :date);";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $dados['cr_nome']);
    $stmt->bindParam(':valor', $dados['cr_valor']);
    $stmt->bindParam(':date', $dados['cr_data']);
    if ($stmt->execute()){
        $retorna = ['erro' => false, 'msg' => "Sucesso no registre!"];
    }else{
        $retorna = ['erro' => true, 'msg' => "Erro ao registrar!"];
    }
};

echo json_encode($retorna);
?>