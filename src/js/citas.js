(function(){   
    document.addEventListener('DOMContentLoaded', function () {
        iniciarApp();
    }); 

    function iniciarApp(){
    let paso = 1;

    //Filtrador para profesionales
    const profesionalesInput = document.querySelector('#buscador');

    if(profesionalesInput){

        profesionalesInput.addEventListener('input', buscarProfesionales);

        function buscarProfesionales(e){
            if (e.target.matches("#buscador")){
      
                document.querySelectorAll(".profesional-cita").forEach(profesional =>{
      
                    profesional.textContent.normalize('NFD').replace(/[\u0300-\u036f]/g, "").toLowerCase().includes(e.target.value.normalize('NFD').replace(/[\u0300-\u036f]/g, "").toLowerCase())
                    ?profesional.classList.remove("filtro")
                    :profesional.classList.add("filtro")
                })
            } 
        }
    }

    const cita = {
        id: '',
        nombre: '',
        email: '',
        fecha: '',
        hora: '',
        motivo: '',
        profesionales: []
    }
    
    mostrarSeccion(); //Muestra la sección que tenga el paso que hayamos puesto en la variable
    tabs(); //Cambia la sección cuando precionamos los tabs

    consultarAPI(); //Consulta la API en el back-end de PHP

    idUsuario();
    nombreUsuario();
    seleccionarFecha();
    seleccionarHora();
    rellenarMotivo();

    mostrarResumen();

    function mostrarSeccion(){
        //Ocultamos la sección que tenga la clase de mostrar (si hay alguno)
        const seccionAnterior = document.querySelector(".mostrar");
        if(seccionAnterior) {
        seccionAnterior.classList.remove('mostrar');
        }

        //Seleccionamos el paso que hemos pulsado en tabs y le añadimos la clase de mostrar
        const seccion = document.querySelector(`#paso-${paso}`);
        seccion.classList.add('mostrar');

        //Quitamos la selección del anterior tab seleccionado
        const tabAnterior = document.querySelector(".citas__boton-actual");
        if(tabAnterior) {
            tabAnterior.classList.remove('citas__boton-actual');
        }

        //Resalta el tab actual
        const tab = document.querySelector(`[data-paso="${paso}"]`);
        tab.classList.add('citas__boton-actual');

    }

    function tabs(){
        const botones = document.querySelectorAll('.citas__tabs button');

        botones.forEach(boton => {
            boton.addEventListener('click', function(e){
                paso = parseInt (e.target.dataset.paso);

                mostrarSeccion();

                if(paso === 3){
                    mostrarResumen();
                }
            })
        })
    }

    async function consultarAPI(){

        try {
            const url = `${location.origin}/api/profesionales`;
            const resultado = await fetch(url);
            const profesionales = await resultado.json();

            mostrarProfesionales(profesionales);
        } catch (error) {
            console.log(error)
        }
    }

    function mostrarProfesionales(profesionales){
        profesionales.forEach(profesional => {
            const {id, nombre, apellido, email, ciudad, provincia} = profesional;

            const nombreProfesional = document.createElement('H4');
            nombreProfesional.classList.add('profesional__nombre');
            nombreProfesional.textContent = nombre;

            const apellidoProfesional = document.createElement('H4');
            apellidoProfesional.classList.add('profesional__apellido');
            apellidoProfesional.textContent = apellido;

            const emailProfesional = document.createElement('P');
            emailProfesional.classList.add('profesional__email');
            emailProfesional.textContent = email;

            const ciudadProfesional = document.createElement('P');
            ciudadProfesional.classList.add('profesional__ubicacion');
            ciudadProfesional.textContent = ciudad;

            const provinciaProfesional = document.createElement('P');
            provinciaProfesional.classList.add('profesional__ubicacion');
            provinciaProfesional.textContent = provincia;

            const profesionalDiv = document.querySelector('.profesional-cita');
            profesionalDiv.dataset.idProfesional = id;
            profesionalDiv.onclick = function(){
                seleccionarProfesional(profesional)
            }

            profesionalDiv.appendChild(nombreProfesional);
            profesionalDiv.appendChild(apellidoProfesional);
            profesionalDiv.appendChild(emailProfesional);
            profesionalDiv.appendChild(ciudadProfesional);
            profesionalDiv.appendChild(provinciaProfesional);

            document.querySelector('#profesionales').appendChild(profesionalDiv);
        })
    }

    function seleccionarProfesional(profesional){
        const { id } = profesional;
        const { profesionales } = cita;

        //Identificamos al elemento al que se da click
        const divProfesional = document.querySelector(`[data-id-profesional="${id}"]`);

        if(profesionales.some( seleccionado => seleccionado.id === id)){
            cita.profesionales = profesionales.filter ( seleccionado => seleccionado.id !== id);
            divProfesional.classList.remove('profesional-cita__seleccionado')
        }else if (profesionales.length >0){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Solamente se puede seleccionar un profesional",
                button: 'OK'
              });  
        } else {
            cita.profesionales = [...profesionales, profesional];
            divProfesional.classList.add('profesional-cita__seleccionado')
        }
    }

    function idUsuario(){
        const id = document.querySelector('#idUsuario').value;
        cita.id = id;
    }

    function nombreUsuario(){
        const nombre = document.querySelector('#nombre').value;
        const email = document.querySelector('#email').value;

        cita.nombre = nombre;
        cita.email = email;
    }

    function seleccionarFecha(){
        const inputFecha = document.querySelector('#fecha');

        inputFecha.addEventListener('input', function(e){
            //Utilizamos getUTCDay que nos da los días del 0 al 6, siendo el 0 domingo y el 6 sábado
            const dia = new Date(e.target.value).getUTCDay();
            if(dia === 0 || dia === 6){
                e.target.value = '';
                mostrarAlerta('Día no disponible', 'error','.formulario');
            } else {
                cita.fecha = e.target.value;
            }
        });
    }

    function seleccionarHora(){
        const inputHora = document.querySelector('#hora');

        inputHora.addEventListener('input', function(e){
            const horaCita = e.target.value;
            const hora = horaCita.split(":")[0];
            if( hora >= 10 && hora < 15 ){
                cita.hora = e.target.value;
            } else if (hora >= 15 && hora < 17 ){
                e.target.value = '';
                mostrarAlerta('Hora no disponible', 'error', '.formulario')
            } else if ( hora >= 17 && hora < 20){
                cita.hora = e.target.value;
            } else {
                e.target.value = '';
                mostrarAlerta('Hora no dispobible', 'error', '.formulario')
            }    
        })

    }

    function rellenarMotivo(){
        const inputMotivo = document.querySelector('#motivo');

        inputMotivo.addEventListener('input', function(e){
            const motivo = e.target.value;
            if(motivo === ''){
                e.target.value = '';
                mostrarAlerta('Debe indicar el motivo de su consulta', 'error','.formulario');
            } else {
                cita.motivo = e.target.value;
            };
        });
    }

    function mostrarAlerta(mensaje, tipo, elemento, desaparece = true){
        //Previene que se genere más de una alerta
        const alertaPrevia = document.querySelector('.alerta');
        if (alertaPrevia){
            alertaPrevia.remove();
        };
        
        //Scripting para crear la alerta
        const alerta = document.createElement('DIV');
        alerta.textContent = mensaje;
        alerta.classList.add('alerta');
        alerta.classList.add(tipo);
        
        const referencia = document.querySelector(elemento);
        referencia.appendChild(alerta);
        
        //Eliminar la alerta
        if(desaparece){
            setTimeout(() => {
                alerta.remove();
            }, 3000);
        }
    }

    function mostrarResumen() {
        const resumen = document.querySelector('.citas__resumen-cita');
    
        // Limpiar el Contenido de Resumen
        while(resumen.firstChild) {
            resumen.removeChild(resumen.firstChild);
        } 
    
        if(Object.values(cita).includes('') || cita.profesionales.length === 0 ) {
            mostrarAlerta('Faltan datos de profesional seleccionado, fecha, hora o motivo de consulta', 'error', '.citas__resumen-cita', false);
    
            return;
        } 

        // Formatear el div de resumen
        const { nombre, email, fecha, hora, motivo, profesionales} = cita;

    
        // Iterando y mostrando el profesional
        profesionales.forEach(profesional => {
            const {nombre, apellido, email} = profesional;
            const contenedorProfesional = document.createElement('DIV');
            contenedorProfesional.classList.add('citas__contenedor-profesionales');
    
            const nombreProfesional = document.createElement('P');
            nombreProfesional.innerHTML = `<span>Nombre profesional:</span> ${nombre} ${apellido}`;
    
            const emailProfesional = document.createElement('P');
            emailProfesional.innerHTML = `<span>Email profesional:</span> ${email}`;
    
            contenedorProfesional.appendChild(nombreProfesional);
            contenedorProfesional.appendChild(emailProfesional);
    
            resumen.appendChild(contenedorProfesional);
        });
    
        const nombreUsuario = document.createElement('P');
        nombreUsuario.innerHTML = `<span>Nombre:</span> ${nombre}`;

        const emailUsuario = document.createElement('P');
        emailUsuario.innerHTML = `<span>Email:</span> ${email}`;
    
        // Formatear la fecha en español
        const fechaObj = new Date(fecha);
        const mes = fechaObj.getMonth();
        const dia = fechaObj.getDate();
        const year = fechaObj.getFullYear();
    
        const fechaUTC = new Date( Date.UTC(year, mes, dia));
        
        const opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'}
        const fechaFormateada = fechaUTC.toLocaleDateString('es-ES', opciones); 
    
        const fechaCita = document.createElement('P');
        fechaCita.innerHTML = `<span>Fecha:</span> ${fechaFormateada}`;
    
        const horaCita = document.createElement('P');
        horaCita.innerHTML = `<span>Hora:</span> ${hora} Horas`;

        const motivoCita = document.createElement('P');
        motivoCita.innerHTML = `<span>Motivo cita:</span> ${motivo}`;
    
        // Boton para Crear una cita
        const botonReservar = document.createElement('BUTTON');
        botonReservar.classList.add('citas__boton--confirmar');
        botonReservar.textContent = 'Confirmar cita';
        botonReservar.onclick = reservarCita;
    
        resumen.appendChild(nombreUsuario);
        resumen.appendChild(emailUsuario);
        resumen.appendChild(fechaCita);
        resumen.appendChild(horaCita);
        resumen.appendChild(motivoCita);
    
        resumen.appendChild(botonReservar);

        console.log(cita);
    }

    async function reservarCita(){
        const {nombre, email, fecha, hora, profesionales, id, motivo} = cita;
        const idProfesional = profesionales.map(profesional => profesional.id);

        const datos = new FormData();
        datos.append('fecha', fecha);
        datos.append('hora', hora);
        datos.append('usuarioId', id);
        datos.append('profesionalId', idProfesional);
        datos.append('motivo', motivo);

        try {
            //Petición hacia la API
            const url = `${location.origin}/api/citas`;
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });
            resultado = await respuesta.json();
        
            if(resultado.resultado){
                Swal.fire({
                    icon: "success",
                    title: "Cita creada",
                    text: "Tu cita se ha reservado correctamente",
                    button: 'OK'
                }).then( () => {
                    setTimeout(() => {
                        location.href ='/usuarios/index';
                    }, 300);
                } )
            }
            
        } catch (error) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Hubo un error al guardar la cita",
                button: 'OK'
              });
        }    
    }
}
})()
