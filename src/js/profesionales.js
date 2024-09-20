(function(){
    const listadoProfesionales = document.querySelector('#listado-profesionales');
    const profesionalesInput = document.querySelector('#profesionales');

    //Buscador de profesionales
    if(profesionalesInput){

    profesionalesInput.addEventListener('input', buscarProfesionales);

    function buscarProfesionales(e){
        if (e.target.matches("#profesionales")){
      
            document.querySelectorAll(".profesional").forEach(profesional =>{
      
                profesional.textContent.normalize('NFD').replace(/[\u0300-\u036f]/g, "").toLowerCase().includes(e.target.value.normalize('NFD').replace(/[\u0300-\u036f]/g, "").toLowerCase())
                  ?profesional.classList.remove("filtro")
                  :profesional.classList.add("filtro")
            })
        } 
    }
}
    
})();

