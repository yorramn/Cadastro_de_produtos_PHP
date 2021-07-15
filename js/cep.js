"use strict";
const preencher = (endereco) =>{
    document.querySelector("#logradouro").value = endereco.logradouro;
    document.querySelector("#bairro").value = endereco.bairro;
    document.querySelector("#estado").value = endereco.localidade;
    document.querySelector("#cidade").value = endereco.localidade;
}
const pesquisarCep = async() =>{
    let cep = document.querySelector("#cep").value;
    let url = "http://viacep.com.br/ws/"+cep+"/json/";
    let dados = await fetch(url);
    let endereco = await dados.json();
    console.log(endereco);
    preencher(endereco);
}

document.querySelector("#cep").addEventListener("focusout",pesquisarCep);
