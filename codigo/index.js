const formulario = document.getElementById("formulario");
const msgAlerta = document.getElementById("msgAlert");

function sumir_msg (){
    msgAlerta.style.display='none';
}

formulario.addEventListener("submit",async (e) =>{
    msgAlerta.style.display='block';
    e.preventDefault();
    if (document.getElementById("login").value === ""){
        msgAlerta.style.textAlign = 'center';
        msgAlerta.style.padding = '10px';
        msgAlerta.style.background= '#e22f2f'
        msgAlerta.style.color = '#ffffff'
        msgAlerta.innerHTML = "Erro: Necessário preencher campo usuario!";
        setTimeout(sumir_msg, 2000);
    } else if (document.getElementById("senha").value === ""){
        msgAlerta.style.textAlign = 'center';
        msgAlerta.style.padding = '10px';
        msgAlerta.style.background= '#e22f2f'
        msgAlerta.style.color = '#ffffff'
        msgAlerta.innerHTML = "Erro: Necessário preencher campo senha!";
        setTimeout(sumir_msg, 2000);
    }else{
        const dadosForm = new FormData(formulario);
        const dados = await fetch("backend/valida.php", {
            method:"POST",
            body: dadosForm

        });
        const resposta = await dados.json();
        console.log(resposta);
        if (resposta['erro'] == true){
            msgAlerta.innerHTML = 'Erro: credenciais inválidas!';
            msgAlerta.style.textAlign = 'center';
            msgAlerta.style.padding = '10px';
            msgAlerta.style.background= '#e22f2f'
            msgAlerta.style.color = '#ffffff'
            setTimeout(sumir_msg, 2000);
        }else{
            msgAlerta.style.display='none';
            formulario.reset();
            const logickey = resposta['msg']['codigo'];
            const nome = resposta['msg']['nome'];
            // sekeyStorage.setItem("nome", nome);
            // sessionStorage.setItem("login", login);
            location.href = "home.php?logickey="+logickey+"&nome="+nome
        };
    }
});

