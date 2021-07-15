function promocao() { 
    let produtos = document.querySelector("#produtos");
    let categorias = document.querySelector("#categoriasC");
    let select = document.querySelector("#promos");
    if (select.value != "") {
        let opcao = select.value;

        if (opcao == "produto") {
            produtos.style.display = "block";
            categorias.style.display = "none";
        }else if(opcao == "categoria"){
            produtos.style.display = "none";
            categorias.style.display = "block";
        }else{
            produtos.style.display = "none";
            categorias.style.display = "none";
        }
        return select.value;
    }
 }
promocao();