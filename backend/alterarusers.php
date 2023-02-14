<?php
include_once('conn.php');

$dados = filter_input_array(INPUT_POST,FILTER_DEFAULT);

// $result = mysqli_query($conn, "INSERT INTO `cadastro` (`nome`, `email`, `telefone`, `sexo`) VALUES ('".$nome."', '".$email."', '".$telefone."', ".$sexo.");");
if(empty($dados['editid'])){
    $retorna = ['erro' => true, 'msg' => "<div>
        Erro! Tente mais Tarde.</div>"];
} elseif(empty($dados['editnome'])){
    $retorna = ['erro' => true, 'msg' => "<div>
        Erro! Necessário preencher o seu Nome.</div>"];
} elseif (empty($dados['editlogin'])){
    $retorna = ['erro' => true, 'msg' => "<div>
        Erro! Necessário preencher o seu login.</div>"];
} else {
    // UPDATE `cadastro` SET `nome` = 'Rafaela Souza' WHERE `cadastro`.`id` = 3; não altera o sexo por ser uma chave estrangeira

    $sql= "UPDATE users SET nome = :nome, login = :login, confirme = :confirme  WHERE id = :id;";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $dados['editnome']);
    $stmt->bindParam(':login', $dados['editlogin']);
    $stmt->bindParam(':confirme', $dados['rad']);
    $stmt->bindParam(':id', $dados['editid']);
    $stmt->execute();
    if($stmt->rowCount()){
        $retorna = ['erro' => false, 'msg' => "<div'>
        Dados do usuario alterados com sucesso!</div>"];
    }else{
        $retorna = ['erro' => true, 'msg' => "<div>
        Erro dados não alterados!</div>"];
    }
};

echo json_encode($retorna);

?>