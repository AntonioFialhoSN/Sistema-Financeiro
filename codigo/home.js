
// const nome = sessionStorage.getItem("nome");
// const login = sessionStorage.getItem("login");

const queryString = window.location.search;

// obtendo a url
let params = new URLSearchParams(window.location.search);

//obtendo nome get
let nome = new URLSearchParams(queryString).get('nome');
let nomeu =  nome;
let acao = '';
//apresentação de grid
let tbody =  document.getElementById("tbody");
const msgAlerta2 = document.getElementById("msgAlert2");
const edForm = document.getElementById("ed-usuario-form");

// apresentação da receita
let  tentradabody = document.getElementById("tentradabody");


function exitusr (){
    edForm.style.display = 'none';
}

function sumir_msg (){
    msgAlerta2.style.display = 'none';

}

//pegando span para atribuir valor na home
const user = document.getElementById("nome");
const qtd_usr = document.getElementById("qtd_usr");
const ed_c = document.getElementById("claro");
const ed_p = document.getElementById("padrao");
const ed_e = document.getElementById("escuro");

// apresenta o nome do usuario logado
user.innerHTML = nome;


// apresenta quantas pessoas tem no sistema
const listusuarios = async ()=>{
    const dados = await fetch("backend/usr.php");
    const resposta = await dados.json();
    //console.log(resposta);
    if (resposta['erro'] == true){
        qtd_usr.innerHTML = 'Erro!';
    }else{
        qtd_usr.innerHTML = resposta['msg']['COUNT(*)'];
    };
    //mostrar quantidade de usuario cadastro
 }

 listusuarios();



 // apresentar faturamento do mês 
 const rec = document.getElementById('receita21');
 now =  new Date;
 const mes = now.getMonth();
 const anos = now.getFullYear();
 //SELECT * FROM `financeiro_saida` WHERE MONTH(dia_vencimento) = 01 AND YEAR(dia_vencimento) = 2023;
 const dadosreceita = async ()=>{
    const dados = await fetch('backend/mesreceita.php?mes=' + mes + '&ano=' + anos);
    const resposta = await dados.json();
    console.log(resposta);
    if (resposta['erro'] == true){
        rec.innerHTML = 'Erro!';
    }else{
        rec.innerHTML = resposta['msg']['SUM(valor)'].toFixed(2);
    };
    //mostrar quantidade de usuario cadastro
 }

 dadosreceita();

 // apresentar dividas do mês

 const div = document.getElementById('divida21');
 //SELECT * FROM `financeiro_saida` WHERE MONTH(dia_vencimento) = 01 AND YEAR(dia_vencimento) = 2023;
 const dadosdividas = async ()=>{
    const dados = await fetch('backend/mesdividas.php?mes=' + mes + '&ano=' + anos);
    const resposta = await dados.json();
    console.log(resposta);
    if (resposta['erro'] == true){
       console.log('Erro!');
    }else{
        div.innerHTML = resposta['msg']['SUM(valor)'].toFixed(2);
    };
    //mostrar quantidade de usuario cadastro
 }

 dadosdividas();




 // edição de cores sistema
 function func(){
    if(ed_p.checked){
        document.querySelector('body').style.setProperty('--var0', '#ffffff');
        document.querySelector('body').style.setProperty('--var1', '#000000bc');
        document.querySelector('body').style.setProperty('--var2', '#0073ff');
        document.querySelector('body').style.setProperty('--var3', '#00ccff');
        document.querySelector('body').style.setProperty('--var4', '#000000');
    } else if(ed_c.checked){
        document.querySelector('body').style.setProperty('--var0', '#ffffff');
        document.querySelector('body').style.setProperty('--var1', '#00ccff');
        document.querySelector('body').style.setProperty('--var2', '#000000bc');
        document.querySelector('body').style.setProperty('--var3', '#00ccff55');
        document.querySelector('body').style.setProperty('--var4', '#000000');
    }else if (ed_e.checked){
        document.querySelector('body').style.setProperty('--var0', '#000000bc');
        document.querySelector('body').style.setProperty('--var1', '#00ccff');
        document.querySelector('body').style.setProperty('--var2', '#ddff00d4');
        document.querySelector('body').style.setProperty('--var3', '#ffffff');
        document.querySelector('body').style.setProperty('--var4', '#ffffff');
    }else{
        console.log('erro');
    }
}

function sair(){
    params.set('logickey', '');
    params.set('nome', '');
    window.location.search = params.toString();
    location.href = "index.html";
}

function casa(){
    // location.reload();
    document.getElementById("home").style.display ='flex';
    document.getElementById("usr").style.display ='none';
    document.getElementById("ent").style.display ='none';
    document.getElementById("sai").style.display ='none';
    document.getElementById("gda").style.display ='none';
    document.getElementById("log").style.display ='none';

}

function sai(){
    document.getElementById("home").style.display ='none';
    document.getElementById("usr").style.display ='none';
    document.getElementById("ent").style.display ='none';
    document.getElementById("sai").style.display ='flex';
    document.getElementById("gda").style.display ='none';
    document.getElementById("log").style.display ='none';
}

function ent(){
    document.getElementById("home").style.display ='none';
    document.getElementById("usr").style.display ='none';
    document.getElementById("ent").style.display ='flex';
    document.getElementById("sai").style.display ='none';
    document.getElementById("gda").style.display ='none';
    document.getElementById("log").style.display ='none';

}

function log(){
    document.getElementById("home").style.display ='none';
    document.getElementById("usr").style.display ='none';
    document.getElementById("ent").style.display ='none';
    document.getElementById("sai").style.display ='none';
    document.getElementById("gda").style.display ='none';
    document.getElementById("log").style.display ='flex';
}

function usr(){
    document.getElementById("home").style.display ='none';
    document.getElementById("usr").style.display ='flex';
    document.getElementById("ent").style.display ='none';
    document.getElementById("sai").style.display ='none';
    document.getElementById("gda").style.display ='none';
    document.getElementById("log").style.display ='none';
}

function gda(){
    document.getElementById("home").style.display ='none';
    document.getElementById("usr").style.display ='none';
    document.getElementById("ent").style.display ='none';
    document.getElementById("sai").style.display ='none';
    document.getElementById("gda").style.display ='flex';
    document.getElementById("log").style.display ='none';
}

// secções user
// apresenta grid de pessoas 
const listausuarios = async ()=>{
    const dados = await fetch("backend/listusr.php");
    const resposta = await dados.text();
    tbody.innerHTML = resposta;
 }

 listausuarios();

 // apagar user
 async function deleteUsuario(id){
    var confirmar  = confirm("Tem certeza que quer apagar o registro");
    if (confirmar == true){
       // console.log(id);
       const dados = await fetch('backend/apagarusers.php?id=' + id);
       const resposta = await dados.json();
       // console.log(resposta);
       msgAlerta2.style.display='absolute';
       listausuarios();
       listusuarios();
       if(resposta['erro']){
          msgAlerta2.innerHTML = resposta['msg'];
          msgAlerta2.style.textAlign = 'center';
          msgAlerta2.style.padding = '10px';
          msgAlerta2.style.background= '#e22f2f'
          msgAlerta2.style.color = '#ffffff'
          setTimeout(sumir_msg, 2000);
       }else{
          acao ='DELETE USER';
          cadlog(nomeu, acao);
          listalog();
          msgAlerta2.innerHTML = resposta['msg'];
          msgAlerta2.style.textAlign = 'center';
          msgAlerta2.style.padding = '10px';
          msgAlerta2.style.background= '#05f505cc'
          msgAlerta2.style.color = '#ffffff'
          listausuarios();
          setTimeout(sumir_msg, 2000);
       }
    }else{
       console.log("Ação de apagar cancelada")
    }
 
 }

 // editar user
 edForm.style.display='none';

 async function editUsuario(id){
    const dados2 = await fetch('backend/visualizarusers.php?id=' + id);
    const resposta1 = await dados2.json();
    console.log(resposta1);
    listausuarios();
    if(resposta1['erro']){
       msgAlerta2.innerHTML = resposta1['msg'];
       msgAlerta2.style.textAlign = 'center';
       msgAlerta2.style.padding = '10px';
       msgAlerta2.style.background= '#e22f2f'
       msgAlerta2.style.color = '#ffffff'
       setTimeout(sumir_msg, 2000);
    }else{
       edForm.style.position='absolute';
       edForm.style.display='block';
       edForm.style.textAlign='center';
       edForm.style.padding='20px';
       edForm.style.background = '#dddddded';
       document.getElementById("editid").value = resposta1['dados'].id;
       document.getElementById("editnome").value = resposta1['dados'].nome;
       document.getElementById("editlogin").value = resposta1['dados'].login;
       if (resposta1['dados'].confirme == 0){
        document.getElementById("editde").checked = true;
       }else{
        document.getElementById("editat").checked = true;
       }
    }
 }


 edForm.addEventListener('submit', async (e)=> {
    e.preventDefault();
    const dadosform =  new FormData(edForm);
    // dadosform.append("add", 1);
    for (var dados1 of dadosform.entries()){
       console.log(dados1[0]+","+dados1[1]);
    }
 
    const dados = await fetch("backend/alterarusers.php", {
       method: "POST",
       body: dadosform
    });
 
    const resposta = await dados.json();
    // console.log(resposta);
    if (resposta['erro']){
        msgAlerta2.innerHTML = resposta['msg'];
        msgAlerta2.style.textAlign = 'center';
        msgAlerta2.style.padding = '10px';
        msgAlerta2.style.background= '#e22f2f'
        msgAlerta2.style.color = '#ffffff'
        setTimeout(sumir_msg, 2000);
    }else{
        acao ='EDITOU USER';
        cadlog(nomeu, acao);
        listalog();
        msgAlerta2.innerHTML = resposta['msg'];
        msgAlerta2.style.textAlign = 'center';
        msgAlerta2.style.padding = '10px';
        msgAlerta2.style.background= '#05f505cc'
        msgAlerta2.style.color = '#ffffff'
        listausuarios();
        setTimeout(sumir_msg, 2000);
    };
 });

 // financeiro entrada 
 const ad_receita =  document.getElementById("ad_receita");
 const tenbody = document.getElementById("tentradabody");
 const acoent = document.getElementById("acoes_entrada");
 const reForm2 = document.getElementById("filtro_entrada2");

 const reForm = document.getElementById("filtro-entrada");
 reForm.addEventListener('submit', async (e)=> {
    e.preventDefault();
    const dadosform =  new FormData(reForm);
    const dados = await fetch("backend/listfinentrada.php", {
       method: "POST",
       body: dadosform
    });
    const resposta = await dados.text();
    tentradabody.innerHTML = resposta;
    console.log(resposta);
 });
 
 function cadreceita (){
    tenbody.style.display = 'none';
    reForm2.style.display= 'none';
    ad_receita.style.display= 'block';
    acoent.style.display= 'none';
    // tenbody.style.display = 'none';
}
 function busreceita(){
    tenbody.style.display = 'inline-block';
    reForm2.style.display= 'block';
    ad_receita.style.display= 'none';
    acoent.style.display= 'none';
 }
 function sacadre(){
    tenbody.style.display = 'none';
    reForm2.style.display= 'none';
    ad_receita.style.display= 'none';
    acoent.style.display= 'flex';
 }

 function sumir_msg2(){
    msgAlerta3.style.display = 'none';
}

 const msgAlerta3 = document.getElementById("msg-alert3");
 const careForm = document.getElementById("cr_form");
 careForm.addEventListener('submit', async (e)=> {
    e.preventDefault();
    // console.log('flag')
    const dadosform =  new FormData(careForm);
    // dadosform.append("add", 1);
    // for (var dados1 of dadosform.entries()){
    //    console.log(dados1[0]+","+dados1[1]);
    // }
 
    const dados = await fetch("backend/cadreceita.php", {
       method: "POST",
       body: dadosform
    });
 
    const resposta = await dados.json();
    // console.log(resposta);
    msgAlerta3.style.display = 'block';
    if (resposta['erro']){
        msgAlerta3.innerHTML = resposta['msg'];
        msgAlerta3.style.textAlign = 'center';
        msgAlerta3.style.padding = '10px';
        msgAlerta3.style.background= '#e22f2f'
        msgAlerta3.style.color = '#ffffff'
        setTimeout(sumir_msg2, 2000);
    }else{
        dadosreceita()
        acao ='CADASTRO RECEITA';
        cadlog(nomeu, acao);
        listalog();
        msgAlerta3.innerHTML = resposta['msg'];
        msgAlerta3.style.textAlign = 'center';
        msgAlerta3.style.padding = '10px';
        msgAlerta3.style.background= '#05f505cc'
        msgAlerta3.style.color = '#ffffff'
        setTimeout(sumir_msg2, 2000);
    };
 });

 async function deletereceita(id){
    var confirmar  = confirm("Tem certeza que quer apagar o registro");
    if (confirmar == true){
       // console.log(id);
       const dados = await fetch('backend/apagareceeita.php?id=' + id);
       const resposta = await dados.json();
       // console.log(resposta);
       msgAlerta3.style.display='block';
       msgAlerta3.style.marginLeft = '700px'
       if(resposta['erro']){
          msgAlerta3.innerHTML = resposta['msg'];
          msgAlerta3.style.textAlign = 'center';
          msgAlerta3.style.padding = '10px';
          msgAlerta3.style.background= '#e22f2f'
          msgAlerta3.style.color = '#ffffff'
          setTimeout(sumir_msg2, 2000);
       }else{
          acao ='DELETOU RECEITA';
          cadlog(nomeu, acao);
          listalog();
          dadosreceita();
          msgAlerta3.innerHTML = resposta['msg'];
          msgAlerta3.style.textAlign = 'center';
          msgAlerta3.style.padding = '10px';
          msgAlerta3.style.background= '#05f505cc'
          msgAlerta3.style.color = '#ffffff'
          setTimeout(sumir_msg2, 2000);
       }
    }else{
       console.log("Ação de apagar cancelada")
    }
 
 }


 const edreForm = document.getElementById("form_alre");

 function sairdereita(){
    edreForm.style.display='none';
 }


 async function editreceita(id){
    const dados2 = await fetch('backend/visualizareceita.php?id=' + id);
    const resposta1 = await dados2.json();
    console.log(resposta1);
    console.log(resposta1['dados'].id);
    if(resposta1['erro']){
       msgAlerta3.innerHTML = resposta1['msg'];
       msgAlerta3.style.textAlign = 'center';
       msgAlerta3.style.padding = '10px';
       msgAlerta3.style.background= '#e22f2f';
       msgAlerta3.style.color = '#ffffff';
       setTimeout(sumir_msg2, 2000);
    }else{
       edreForm.style.display= 'block';
       edreForm.style.position= 'absolute';
       edreForm.style.display= 'block';
       edreForm.style.textAlign= 'center';
       edreForm.style.padding= '20px';
       edreForm.style.background = '#dddddded';
       edreForm.style.marginLeft='300px';
       edreForm.style.marginTop = '20px';
       document.getElementById("edr_id").value = resposta1['dados'].id;
       document.getElementById("edr_nome").value = resposta1['dados'].nome;
       document.getElementById("edr_valor").value = resposta1['dados'].valor;
       document.getElementById("edr_date").value = resposta1['dados'].dia_entrada;
    }
 }

 edreForm.addEventListener('submit', async (e)=> {
    e.preventDefault();
    const dadosform =  new FormData(edreForm);
    // dadosform.append("add", 1);
    for (var dados1 of dadosform.entries()){
       console.log(dados1[0]+","+dados1[1]);
    }
 
    const dados = await fetch("backend/alterareceita.php", {
       method: "POST",
       body: dadosform
    });
 
    const resposta = await dados.json();
    // console.log(resposta);
    if (resposta['erro']){
        msgAlerta3.innerHTML = resposta['msg'];
        msgAlerta3.style.textAlign = 'center';
        msgAlerta3.style.padding = '10px';
        msgAlerta3.style.background= '#e22f2f'
        msgAlerta3.style.color = '#ffffff'
        setTimeout(sumir_msg2, 2000);
    }else{
        acao ='ALTEROU RECEITA';
        cadlog(nomeu, acao);
        listalog();
        dadosreceita();
        msgAlerta3.innerHTML = resposta['msg'];
        msgAlerta3.style.textAlign = 'center';
        msgAlerta3.style.padding = '10px';
        msgAlerta3.style.background= '#05f505cc'
        msgAlerta3.style.color = '#ffffff'
        setTimeout(sumir_msg2, 2000);
    };
 });

  // financeiro saida
  const tsaidabody = document.getElementById("tsaidabody");
  const msgAlerta4 = document.getElementById("msg-alert4");
  const diForm2 = document.getElementById("filtro_saida2");
  const ad_divida =  document.getElementById("ad_divida");
  const acosaida = document.getElementById("acoes_saida");

  const diForm = document.getElementById("filtro-saida");
  diForm.addEventListener('submit', async (e)=> {
     e.preventDefault();
     const dadosform =  new FormData(diForm);
     const dados = await fetch("backend/listfinsaida.php", {
        method: "POST",
        body: dadosform
     });
     const resposta = await dados.text();
     tsaidabody.innerHTML = resposta;
     console.log(resposta);
  });

  function caddivida(){
    tsaidabody.style.display = 'none';
    diForm2.style.display= 'none';
    ad_divida.style.display= 'block';
    acosaida.style.display= 'none';
    // tsaidabody.style.display = 'none';
}
  function busdivida(){
    tsaidabody.style.display = 'inline-block';
    diForm2.style.display= 'block';
    ad_divida.style.display= 'none';
    acosaida.style.display= 'none';
 }
  function sacaddi(){
    tsaidabody.style.display = 'none';
    diForm2.style.display= 'none';
    ad_divida.style.display= 'none';
    acosaida.style.display= 'flex';
 }

  function sumir_msg3(){
    msgAlerta4.style.display = 'none';
}

const cadiForm = document.getElementById("cd_form");
 cadiForm.addEventListener('submit', async (e)=> {
    e.preventDefault();
    // console.log('flag')
    const dadosform =  new FormData(cadiForm);
    // dadosform.append("add", 1);
    // for (var dados1 of dadosform.entries()){
    //    console.log(dados1[0]+","+dados1[1]);
    // }
 
    const dados = await fetch("backend/caddivida.php", {
       method: "POST",
       body: dadosform
    });
 
    const resposta = await dados.json();
    // console.log(resposta);
    msgAlerta4.style.display = 'block';
    if (resposta['erro']){
        msgAlerta4.innerHTML = resposta['msg'];
        msgAlerta4.style.textAlign = 'center';
        msgAlerta4.style.padding = '10px';
        msgAlerta4.style.background= '#e22f2f'
        msgAlerta4.style.color = '#ffffff'
        setTimeout(sumir_msg3, 2000);
    }else{
        acao ='ADICINOU DIVIDA';
        cadlog(nomeu, acao);
        listalog();
        dadosdividas();
        msgAlerta4.innerHTML = resposta['msg'];
        msgAlerta4.style.textAlign = 'center';
        msgAlerta4.style.padding = '10px';
        msgAlerta4.style.background= '#05f505cc'
        msgAlerta4.style.color = '#ffffff'
        setTimeout(sumir_msg3, 2000);
    };
 });

 async function deletedivida(id){
    var confirmar  = confirm("Tem certeza que quer apagar o registro");
    if (confirmar == true){
       // console.log(id);
       const dados = await fetch('backend/apagardivida.php?id=' + id);
       const resposta = await dados.json();
       // console.log(resposta);
       msgAlerta4.style.display='block';
       msgAlerta4.style.marginLeft = '700px'
       if(resposta['erro']){
          msgAlerta4.innerHTML = resposta['msg'];
          msgAlerta4.style.textAlign = 'center';
          msgAlerta4.style.padding = '10px';
          msgAlerta4.style.background= '#e22f2f'
          msgAlerta4.style.color = '#ffffff'
          setTimeout(sumir_msg3, 2000);
       }else{
          acao ='APAGOU DIVIDA';
          cadlog(nomeu, acao);
          listalog();
          dadosdividas();
          msgAlerta4.innerHTML = resposta['msg'];
          msgAlerta4.style.textAlign = 'center';
          msgAlerta4.style.padding = '10px';
          msgAlerta4.style.background= '#05f505cc'
          msgAlerta4.style.color = '#ffffff'
          setTimeout(sumir_msg3, 2000);
       }
    }else{
       console.log("Ação de apagar cancelada")
    }
 
 }

 function exitdivida(){
    eddiForm.style.display='none';
 }

 const eddiForm = document.getElementById("form_aldi");

 async function editdivida(id){
    const dados2 = await fetch('backend/visualizadivida.php?id=' + id);
    const resposta1 = await dados2.json();
    // console.log(resposta1);
    // console.log(resposta1['dados'].dia_vencimento);
    if(resposta1['erro']){
       msgAlerta4.innerHTML = resposta1['msg'];
       msgAlerta4.style.textAlign = 'center';
       msgAlerta4.style.padding = '10px';
       msgAlerta4.style.background= '#e22f2f';
       msgAlerta4.style.color = '#ffffff';
       setTimeout(sumir_msg3, 2000);
    }else{
       eddiForm.style.display= 'block';
       eddiForm.style.position= 'absolute';
       eddiForm.style.display= 'block';
       eddiForm.style.textAlign= 'center';
       eddiForm.style.padding= '20px';
       eddiForm.style.background = '#dddddded';
       eddiForm.style.marginLeft='300px';
       eddiForm.style.marginTop = '20px';
       document.getElementById("edd_id").value = resposta1['dados'].id;
       document.getElementById("edd_nome").value = resposta1['dados'].nome;
       document.getElementById("edd_valor").value = resposta1['dados'].valor;
       document.getElementById("edd_date").value = resposta1['dados'].dia_vencimento;
    }
 }

 eddiForm.addEventListener('submit', async (e)=> {
    e.preventDefault();
    const dadosform =  new FormData(eddiForm);
    // dadosform.append("add", 1);
    for (var dados1 of dadosform.entries()){
       console.log(dados1[0]+","+dados1[1]);
    }
 
    const dados = await fetch("backend/alteradivida.php", {
       method: "POST",
       body: dadosform
    });
    const resposta = await dados.json();
    // console.log(resposta);
    if (resposta['erro']){
        msgAlerta4.innerHTML = resposta['msg'];
        msgAlerta4.style.textAlign = 'center';
        msgAlerta4.style.padding = '10px';
        msgAlerta4.style.background= '#e22f2f'
        msgAlerta4.style.color = '#ffffff'
        setTimeout(sumir_msg3, 2000);
    }else{
        acao ='EDITOU DIVIDA';
        cadlog(nomeu, acao);
        listalog();
        dadosdividas();
        msgAlerta4.innerHTML = resposta['msg'];
        msgAlerta4.style.textAlign = 'center';
        msgAlerta4.style.padding = '10px';
        msgAlerta4.style.background= '#05f505cc'
        msgAlerta4.style.color = '#ffffff'
        setTimeout(sumir_msg3, 2000);
    };
})


// mostra log

const tlogbody = document.getElementById("tlogbody")
const listalog = async ()=>{
   const dados = await fetch("backend/listlog.php");
   const resposta = await dados.text();
   tlogbody.innerHTML = resposta;
}
listalog();


const filtro_log = document.getElementById("filtro-log")
filtro_log .addEventListener('submit', async (e)=> {
   e.preventDefault();
   const dadosform =  new FormData(filtro_log);
   // dadosform.append("add", 1);
   for (var dados1 of dadosform.entries()){
      console.log(dados1[0]+","+dados1[1]);
   }

   const dados = await fetch("backend/baixarlog.php", {
      method: "POST",
      body: dadosform
   });
   const resposta = await dados.text();
   // define a variável
   // console.log(resposta);

   // abre uma nova janela
   let newWindow = window.open();
   
   // cria um elemento HTML na nova janela
   let newElement = newWindow.document.createElement("div");
   
   // insere o conteúdo da variável no elemento HTML
   newElement.innerHTML = resposta;
   
   // adiciona o elemento à página
   newWindow.document.body.appendChild(newElement);
})



// ação 

const cadlog = async (nomeu, acao)=>{
   // tempo
   let currentDate = new Date();

   // obtém o dia atual
   let currentDay = currentDate.getDate();

   // obtém o mês atual (janeiro = 0, fevereiro = 1, etc)
   let currentMonth = (currentDate.getMonth()) + 1;
   let mesesMounth = '';
   if (currentMonth > 9){
       mesesMounth = currentMonth; 
  }else{
       mesesMounth= '0'+currentMonth;
  }

   // obtém o ano atual
   let currentYear = currentDate.getFullYear();

   // obtém a hora atual
   let currentHour = currentDate.getHours();
   let hora = '';
   if (currentHour > 9){
      hora = currentHour; 
   }else{
      hora= '0'+currentHour;
   }

   // obtém os minutos atuais
   let currentMinutes = currentDate.getMinutes();
   let minutos = '';
   if (currentMinutes > 9){
      minutos = currentMinutes; 
   }else{
      minutos= '0'+currentMinutes;
   }

   // obtém os segundos atuais
   let currentSeconds = currentDate.getSeconds();
   let segundos = '';
   if (currentSeconds > 9){
      segundos = currentSeconds; 
   }else{
      segundos= '0'+currentSeconds;
   }


   let tempolog = currentYear+'-'+mesesMounth+'-'+currentDay+' '+hora+':'+minutos+':'+segundos+'';
   console.log(tempolog);
   const dados = await fetch("backend/adlog.php?nome=" + nomeu + "&acao=" + acao + "&tempo=" + tempolog);
   console.log(dados);
   const resposta = await dados.json();
   console.log(resposta);
   if (resposta['erro'] == true){
       console.log('Erro!'+ resposta['msg']);
   }else{
      console.log(resposta['msg']);
   };
   //mostrar quantidade de usuario cadastro
}