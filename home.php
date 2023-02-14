<?php
$cod = $_GET['logickey'];
if($cod == '55Ddmd5dxdlq5pih8sm4nx83'){
}else{
     header("Location: error.php");
     die();
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilo/stylehome.css">
    <script src="https://kit.fontawesome.com/37957a4d51.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <div><button onclick="sai()"><i class="fa-solid fa-circle-dollar-to-slot"></i></button></div>
        <div><button onclick="ent()"><i class="fa-solid fa-sack-dollar"></i></button></div>
        <div><button onclick="log()"><i class="fa-solid fa-shield"></i></button></div>
        <div><button onclick="casa()"><i class="fa-solid fa-house"></i></button></div>
        <div><button onclick="usr()"><i class="fa-solid fa-address-book"></i></button></div>
        <div><button onclick="gda()"><i class="fa-solid fa-table"></i></button></div>
        <div><button onclick="sair()"><i class="fa-solid fa-right-from-bracket"></i></button></div>
                <!--
            home
            logs estilo
            Finanças entra 
            ..      saida 
            usuários
            saida
            analise
        -->
    </header>
    <section class="home" id="home">
        <div class="fin_en">
            <i class="fa-solid fa-dollar-sign"></i><br>
            <span> R$: </span><span id="receita21"></span>
        </div>
        <div class= "users">
            <i class="fa-solid fa-user-group"></i><br>
            <span id="qtd_usr"></span>
        </div>
        <div  class="fin_sa">
            <i class="fa-solid fa-dollar-sign"></i><br>
            <span> R$: </span><span id="divida21"></span>
        </div>
        <div  class="estilo">
            <i class="fa-solid fa-palette"></i><br>
            <span><input type="radio" name="select" id="padrao" onclick="func()" checked>Padrão</span>
            <span><input type="radio" name="select" id="claro" onclick="func()">Claro</span>
            <span><input type="radio" name="select" id="escuro" onclick="func()">Escuro</span>
        </div>
    </section>
    <section class="user" id="usr">
        <form id="ed-usuario-form"  style="position: absolute; margin-left: 350px; width: 200px; height:250px;" method="post">
            <label>Id:</label>
            <input type="number" name="editid" id="editid"><br>
            <label>Nome:</label>
            <input type="text" name="editnome" id="editnome"><br>
            <label>Login:</label>
            <input type="text" name="editlogin" id="editlogin"><br>
            <label>Status</label><br>
            <label>Desativado: </label>
            <input type="radio" name="rad" id="editde" value='0'><br>
            <label>Ativado: </label>
            <input type="radio" name="rad" id="editat" value='1'><br>
            <input type="submit" value="Salvar"><span>       </span>
            <button type="button" onclick="exitusr()">Sair</button>
        </form>
        <div id="msgAlert2" style="position: absolute;">
        </div>
        <div class="tbody" id="tbody">
        </div>
    </section>

    <section class="fin_entrada" id="ent">
        <form method="post" id="form_alre" style="display: none; position: absolute;">
            <label> Id:</label>
            <input type="number" name="edr_id" id="edr_id"><br>
            <label> Nome: </label>
            <input type="text" name="edr_nome" id="edr_nome"><br>
            <label> Valor:</label>
            <input type="number" step="0.01" name="edr_valor" id="edr_valor" min="0.01"><br>
            <label>Data: </label>
            <input type="date" name="edr_date" id="edr_date"><br>
            <input type="submit" value="Salvar">
            <button type="button" onclick="sairdereita()">Sair</button>
        </form>
        <div id="msg-alert3" style="display: none; position: absolute;">
        </div>
        <div class="acoes_entrada" id="acoes_entrada">
            <button style='margin-right: 20px; width: 150px; height:20px;' onclick='busreceita()'>Buscar receita</button>
            <span>   </span>
            <button style='margin-left: 20px; width: 150px; height:20px;' onclick='cadreceita()'>Cadastro receita</button>
        </div> 
        <div class="ad_receita" id="ad_receita">
            <form id="cr_form" class="cr_form"  style=" background:#eeeeeedf; border-radius: 10px;">
                <label>Nome: </label>
                <input type="text" name="cr_nome" id="cr_nome"><br>
                <label>Valor: </label>
                <input type="number" step="0.01" name="cr_valor" id="cr_valor" min="0.01"><br>
                <label>Data: </label><br>
                <input type="date" name="cr_data" id="cr_data"><br>
                <input type="submit" value=" Salvar ">
                <button type="button" onclick="sacadre()"> Sair </button>
            </form>
        </div>
        <div class="filtro_entrada2" id="filtro_entrada2">
            <form method="post" id="filtro-entrada">
                <label>Filtro: </label>
                <input type="date" name="inicio-entrada" id="inicio-entrada">
                <span> de </span>
                <input type="date" name="fim-entrada" id="fim-entrada">
                <input type="submit" value=" Pesquisar ">
                <button type="button" onclick="sacadre()"> Sair </button>
            </form>
        </div>
        <div class="tentradabody" id="tentradabody">
        </div>
    </section>
    <section class="fin_saida" id="sai">
        <form method="post" id="form_aldi" style="display: none; position: absolute;">
            <label> Id:</label>
            <input type="number" name="edd_id" id="edd_id"><br>
            <label> Nome: </label>
            <input type="text" name="edd_nome" id="edd_nome"><br>
            <label> Valor:</label>
            <input type="number" step="0.01" name="edd_valor" id="edd_valor" min="0.01"><br>
            <label>Data: </label>
            <input type="date" name="edd_date" id="edd_date"><br>
            <input type="submit" value="Salvar">
            <button type="button" onclick="exitdivida()">Sair</button>
        </form>
        <div class="acoes_saida" id="acoes_saida">
            <button style='margin-right: 20px; width: 150px; height:20px;' onclick='busdivida()'>Buscar divida</button>
            <span>   </span>
            <button style='margin-left: 20px; width: 150px; height:20px;' onclick='caddivida()'>Cadastro divida</button>
        </div> 
        <div id="msg-alert4" style="display: none; position: absolute;">
        </div>
        <div class="ad_divida" id="ad_divida">
            <form id="cd_form" class="cd_form"  style=" background:#eeeeeedf; border-radius: 10px;">
                <label>Nome: </label>
                <input type="text" name="cr_nome" id="cr_nome"><br>
                <label>Valor: </label>
                <input type="number" step="0.01" name="cr_valor" id="cr_valor" min="0.01"><br>
                <label>Data: </label><br>
                <input type="date" name="cr_data" id="cr_data"><br>
                <input type="submit" value=" Salvar">
                <button type="button" onclick="sacaddi()"> Sair </button>
            </form>
        </div>
        <div class="filtro_saida2" id="filtro_saida2">
            <form method="post" id="filtro-saida">
                <label>Filtro: </label>
                <input type="date" name="inicio-saida" id="inicio-saida">
                <span> de </span>
                <input type="date" name="fim-saida" id="fim-saida">
                <input type="submit" value=" Pesquisar ">
                <button  type="button" onclick="sacaddi()"> Sair </button>
            </form>
        </div>
        <div class="tsaidabody" id="tsaidabody">
        </div>
    </section>
    <section class="analise" id="gda">

    </section>
    <section class="conf" id="log">
        <div class="filtro_log2" id="filtro_log2">
            <form method="post" id="filtro-log">
                <label>Filtro: </label>
                <input type="date" name="inicio-log" id="inicio-log">
                <span> de </span>
                <input type="date" name="fim-log" id="fim-log">
                <input type="submit" value="Ver">
            </form>
        </div>
        <div class="tlogbody" id="tlogbody">
        </div>
    </section>
    <footer>
        <div class="iden">
            <i class="fa-regular fa-user"></i>
            <span id="nome"> </span>
        </div>
        <div class="mar">
            Sistema criado por:  <span> Antonio Fialho </span> &copy;
        </div>
    </footer>
    <script src="codigo/home.js"></script>
</body>
</html>