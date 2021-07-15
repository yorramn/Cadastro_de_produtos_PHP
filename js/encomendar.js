document.querySelector("#filtrar").addEventListener("click",function(){
    let filter = document.querySelector("#filter");
    let txt = filtro();
    filter.value = txt;
    
})
function encomendar() { 
    let select = document.querySelector("#categorias");
    if (select.value != "") {
        let opcao = select.value;
        switch (opcao) {
            case "Produto":
                console.log("Produto");
                break;
        
            default:
                break;
        }
        return select.value;
    }
    
 }
 encomendar();