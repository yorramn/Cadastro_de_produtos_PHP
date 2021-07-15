"use strict";
document.querySelector("#confirmar").addEventListener("click",function(){
    let res = document.querySelector("#res");
    let frm = document.querySelector("#frm");
  
    res.innerHTML = "R$ "+formula.quantidadeC.value * formula.preco.value;
    let forma = forma_pagamento();
    frm.innerHTML = "A forma de pagamento é: "+forma;
})

function forma_pagamento() {
    let select = document.querySelector("#formas");
    return select.value;
}  


