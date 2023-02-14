<?php
include_once('conn.php');

$dados = filter_input_array(INPUT_POST,FILTER_DEFAULT);

// $result = mysqli_query($conn, "INSERT INTO `cadastro` (`nome`, `email`, `telefone`, `sexo`) VALUES ('".$nome."', '".$email."', '".$telefone."', ".$sexo.");");
if(empty($dados['edr_id'])){
    $retorna = ['erro' => true, 'msg' => "<div>
        Erro! Tente mais Tarde.</div>"];
} elseif(empty($dados['edr_nome'])){
    $retorna = ['erro' => true, 'msg' => "<div>
        Erro! Necessário preencher o Nome.</div>"];
} elseif (empty($dados['edr_valor'])){
    $retorna = ['erro' => true, 'msg' => "<div>
        Erro! Necessário preencher o seu valor.</div>"];
} else {
    // UPDATE `cadastro` SET `nome` = 'Rafaela Souza' WHERE `cadastro`.`id` = 3; não altera o sexo por ser uma chave estrangeira

    $sql= "UPDATE financeiro_entrada SET nome = :nome, valor = :valor, dia_entrada = :data   WHERE id = :id;";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $dados['edr_nome']);
    $stmt->bindParam(':valor', $dados['edr_valor']);
    $stmt->bindParam(':data', $dados['edr_date']);
    $stmt->bindParam(':id', $dados['edr_id']);
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