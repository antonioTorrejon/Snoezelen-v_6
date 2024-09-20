(function(){

const modal = document.querySelector(".disciplina__modal");
const verMas = document.querySelector("#botonModal");
const cerrar = document.querySelector("#botonCerrar");

    verMas.addEventListener("click", () => { 
        modal.showModal();
    });

    cerrar.addEventListener("click", () => {
        modal.close();
    }) 
    
})();




