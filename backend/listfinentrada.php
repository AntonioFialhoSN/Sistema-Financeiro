<?php
include_once "conn.php";
include_once "mascara.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$query_usuarios = "SELECT * FROM `financeiro_entrada` where dia_entrada BETWEEN :inicio and :fim;";
$grid_usuarios = $conn->prepare($query_usuarios);
$grid_usuarios->bindParam(':inicio', $dados['inicio-entrada']);
$grid_usuarios->bindParam(':fim', $dados['fim-entrada']);
$grid_usuarios->execute();

$dados = "<div class='table-responsive'>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>VALOR</th>
                        <th>DIA</th>
                        <th>FUNÇÕES
                        </th>
                    </tr>
                </thead>
                <tbody>";
while ($row_usuario = $grid_usuarios ->fetch(PDO::FETCH_ASSOC)){
    // var_dump($row_usuario);
    extract($row_usuario);
    // echo"<td>".$row_usuario['id']."<br></td>"; 
    // ao dar extract não precisso desse formato 
    $dados .= "<tr><td>$id</td>
                <td>$nome</td>
                <td>$valor</td>
                <td>".mask($dia_entrada,'##/##/####')."</td>
                <td>
                <button id='$id' class='btnwarning' onclick='editreceita($id)' > Alterar </button>

                <button id='$id' class='btndanger' onclick='deletereceita($id)'> Apagar </button>
                </td>
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
                    <th>VALOR</th>
                    <th>DIA</th>
                    <th>FUNÇÕES</th>
                </tr>
            </thead>
        </table>
    </div>";
    //paginação - somar quantidaded de usuarios

echo $dados; 
