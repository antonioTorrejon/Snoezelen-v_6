(function(){  

    document.addEventListener('DOMContentLoaded', function () {
        iniciarApp();
    });

    //Buscador de citas por fecha
    function iniciarApp(){
        buscarPorFecha ();
    }

    function buscarPorFecha(){
        const fechaInput = document.querySelector('#fecha-filtro');
        fechaInput.addEventListener('input', function(e){
            const fechaSeleccionada = e.target.value;
            window.location = `?fecha=${fechaSeleccionada}`;
        })
    }

})()
