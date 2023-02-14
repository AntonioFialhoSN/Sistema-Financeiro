<?php
include_once "conn.php";

$query_usuarios = "SELECT id, nome, login, confirme From users ;";
$grid_usuarios = $conn->prepare($query_usuarios);
$grid_usuarios->execute();

$dados = "<div class='table-responsive'>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>LOGIN</th>
                        <th>CONFIRME</th>
                        <th>FUNÇÕES</th>
                    </tr>
                </thead>
                <tbody>";
while ($row_usuario = $grid_usuarios ->fetch(PDO::FETCH_ASSOC)){
    // var_dump($row_usuario);
    extract($row_usuario);
    // echo"<td>".$row_usuario['id']."<br></td>"; 
    // ao dar extract não precisso desse formato 
    if($confirme == '1'){
        $res = "Ativado";
    }else{
        $res = "Desativado";
    }
    $dados .= "<tr><td>$id</td>
                <td>$nome</td>
                <td>$login</td>
                <td>$res</td>
                <td>
                <button id='$id' class='btnwarning' onclick='editUsuario($id)' > Alterar </button>

                <button id='$id' class='btndanger' onclick='deleteUsuario($id)'> Apagar </button>
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
                    <th>LOGIN</th>
                    <th>CONFIRME</th>
                    <th>FUNÇÕES</th>
                </tr>
            </thead>
        </table>
    </div>";
    //paginação - somar quantidaded de usuarios

echo $dados; 
