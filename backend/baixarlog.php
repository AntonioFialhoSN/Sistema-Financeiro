<?php
include_once "conn.php";
include_once "mascara.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if(isset($dados['inicio-log']) and isset($dados['fim-log'])){
    $inicio = $dados['inicio-log'].' 00:00:00';
    $fim = $dados['fim-log'].' 23:59:59';
} else {
    echo 'Erro, sem parametro!';
}

$query_usuarios = "SELECT * FROM `log` where hora_data BETWEEN :inicio and :fim;";
$grid_usuarios = $conn->prepare($query_usuarios);
$grid_usuarios->bindParam(':inicio', $inicio);
$grid_usuarios->bindParam(':fim', $fim);
$grid_usuarios->execute();

$dados = "<div class='table-responsive'>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>AÇÃO</th>
                        <th>DATA</th>
                        <th>HORARIO</th>
                    </tr>
                </thead>
                <tbody>";
while ($row_usuario = $grid_usuarios ->fetch(PDO::FETCH_ASSOC)){
    // var_dump($row_usuario);
    extract($row_usuario);
    // echo"<td>".$row_usuario['id']."<br></td>"; 
    // ao dar extract não precisso desse formato 
    $data = substr($hora_data, 0, 10);
    $hora = substr($hora_data, 11, 19);
    $dados .= "<tr><td>$id</td>
                <td>$nome</td>
                <td>$acao</td>
                <td>".mask($data, '##/##/####')."</td>
                <td>$hora</td>
                </tr>";

                
    // echo "<br><td>$id</td> - <span>";
    // echo "<td>$nome</td> - <span>";
    // echo "<td>$email</td> - <span>";
    // echo "<td>$telefone</td> - <span>";
    // echo "<td>$sexo</td><span>  <br>"; // só teste
}

$dados .= "</tbody>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>AÇÃO</th>
                    <th>DATA</th>
                    <th>HORARIO</th>
                </tr>
            </thead>
        </table>
    </div>";
    //paginação - somar quantidaded de usuarios

echo $dados; 
