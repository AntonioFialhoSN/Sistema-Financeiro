<?php
include_once('conn.php');

$dados = filter_input_array(INPUT_POST,FILTER_DEFAULT);

// $result = mysqli_query($conn, "INSERT INTO `cadastro` (`nome`, `email`, `telefone`, `sexo`) VALUES ('".$nome."', '".$email."', '".$telefone."', ".$sexo.");");
if(empty($dados['edd_id'])){
    $retorna = ['erro' => true, 'msg' => "<div>
        Erro! Tente mais Tarde.</div>"];
} elseif(empty($dados['edd_nome'])){
    $retorna = ['erro' => true, 'msg' => "<div>
        Erro! Necessário preencher o Nome.</div>"];
} elseif (empty($dados['edd_valor'])){
    $retorna = ['erro' => true, 'msg' => "<div>
        Erro! Necessário preencher o valor.</div>"];
} else {
    // UPDATE `cadastro` SET `nome` = 'Rafaela Souza' WHERE `cadastro`.`id` = 3; não altera o sexo por ser uma chave estrangeira

    $sql= "UPDATE financeiro_saida SET nome = :nome, valor = :valor, dia_vencimento = :data WHERE id = :id;";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $dados['edd_nome']);
    $stmt->bindParam(':valor', $dados['edd_valor']);
    $stmt->bindParam(':data', $dados['edd_date']);
    $stmt->bindParam(':id', $dados['edd_id']);
    $stmt->execute();
    if($stmt->rowCount()){
        $retorna = ['erro' => false, 'msg' => "<div'>
        Dados alterados com sucesso!</div>"];
    }else{
        $retorna = ['erro' => true, 'msg' => "<div>
        Erro dados não alterados!</div>"];
    }
};

echo json_encode($retorna);

?>