const formulario = document.getElementById("formulario");
const msgAlerta = document.getElementById("msgAlert");

function sumir_msg (){
    msgAlerta.style.display='none';
}

formulario.addEventListener("submit", async (e)=> {
    e.preventDefault();
    const dadosform =  new FormData(formulario);
    const dados =  await fetch ('backend/cadastro.php', {
        method: "POST",
        body: dadosform,
    });
    console.log(dadosform.get('nome'));
    console.log(dadosform.get('login'));
    console.log(dadosform.get('senha'));
    console.log(dadosform.get('con_senha'));
    const resposta = await dados.json();
    formulario.reset();
    msgAlerta.style.display='block';
    if (resposta['erro']){
        msgAlerta.style.textAlign = 'center';
        msgAlerta.style.padding = '10px';
        msgAlerta.style.background= '#e22f2f'
        msgAlerta.style.color = '#ffffff'
        msgAlerta.innerHTML = resposta['msg'];
        setTimeout(sumir_msg, 2000);
     }else{
        msgAlerta.style.textAlign = 'center';
        msgAlerta.style.padding = '10px';
        msgAlerta.style.background= '#26b350'
        msgAlerta.style.color = '#ffffff'
        msgAlerta.innerHTML = resposta['msg'];
        setTimeout(sumir_msg, 2000);
     };
})