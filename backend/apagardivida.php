<?php

include_once "conn.php";

$id= filter_input(INPUT_GET,"id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {

    /*"DELETE FROM cadastro WHERE `cadastro`.`id` = 48"*/
    $query_usuario = "DELETE FROM financeiro_saida WHERE financeiro_saida.id = :id";
    $stmt = $conn ->prepare($query_usuario);
    $stmt->bindParam(':id', $id);
    if( $stmt->execute()){
        $retorna = ['erro' => false, 'msg' => "<div>
    Registro foi deletado com sucesso!
    </div>"];
    }else{
        $retorna = ['erro' => true, 'msg' => "<div>
    Registro não foi deletado!
    </div>"];
    }
}else{
    // variavel recebendo array , onde o 1 erro, 2 msg para isso usa json encode 
   $retorna = ['erro' => true, 'msg' => "<div>
    Nenhum registro foi encontrada!
    </div>"];
}

echo json_encode($retorna);


