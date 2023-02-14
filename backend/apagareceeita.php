<?php

include_once "conn.php";

$id= filter_input(INPUT_GET,"id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {

    /*"DELETE FROM cadastro WHERE `cadastro`.`id` = 48"*/
    $query_usuario = "DELETE FROM financeiro_entrada WHERE financeiro_entrada.id = :id";
    $stmt = $conn ->prepare($query_usuario);
    $stmt->bindParam(':id', $id);
    if( $stmt->execute()){
        $retorna = ['erro' => false, 'msg' => "<div>
    Usuário foi deletado com sucesso!
    </div>"];
    }else{
        $retorna = ['erro' => true, 'msg' => "<div>
    Usuário não foi deletado!
    </div>"];
    }
}else{
    // variavel recebendo array , onde o 1 erro, 2 msg para isso usa json encode 
   $retorna = ['erro' => true, 'msg' => "<div>
    Nenhum usuário foi encontrada!
    </div>"];
}

echo json_encode($retorna);










?>