<?php
// session_start(); 
include_once 'conn.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(empty($dados['login'])){
    $retorna = ['erro'=> true, 'msg' => "Erro: Necessário preencher campo usuario!php"];
}elseif(empty($dados['senha'])){
    $retorna = ['erro'=> true, 'msg' => "Erro: Necessário preencher campo senha!php"];
} else{
    $query = "SELECT *
    FROM users 
    WHERE login=:login 
    LIMIT 1";
    $result = $conn->prepare($query);
    $result -> bindParam(':login', $dados['login'], PDO::PARAM_STR);
    $result->execute();

    if(($result) and ($result->rowCount() != 0)){
        $row_usuario = $result->fetch(PDO::FETCH_ASSOC);
        if ($dados['senha'] != $row_usuario['senha']){
            $retorna = ['erro'=> true, "Erro: credenciais inválidas!"];
        }else if ($row_usuario['confirme'] == 0){
            $retorna = ['erro'=> true, "Erro: não autorizado!"];
        }else{
            $retorna = ['erro'=> false, 'msg' => $row_usuario];
        }
    }else{
        $retorna = ['erro'=> true, 'msg' => "Erro: credenciais inválidas!"];
    }

}

echo json_encode($retorna);

// erro de logica na condicional

// if(($dados['senha'] == $row_usuario['senha']) && ($row_usuario['confirme'] == 1)){
//     $retorna = ['erro'=> false, 'msg' => $row_usuario];
// }elseif ($dados['senha'] != $row_usuario['senha']){
//     $retorna = ['erro'=> true, "Erro: credenciais inválidas!"];
// }else{
//     $retorna = ['erro'=> true, "Erro: credenciais inválidas!"];
// }
