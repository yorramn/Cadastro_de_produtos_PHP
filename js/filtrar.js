document.querySelector("#filtrar").addEventListener("click",function(){
    let filter = document.querySelector("#filter");
    let txt = filtro();
    filter.value = txt;
    
})
function filtro() { 
    let select = document.querySelector("#categorias");
    return select.value;
 }