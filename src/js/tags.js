(function(){
    //Inclusión de tags pulsando una coma y eliminación con doble click
    const tagsInput = document.querySelector('#tags_input');

    if(tagsInput){
        const tagsDiv = document.querySelector('#tags');
        const tangsInputHidden = document.querySelector('[name="tags"]');
        let tags = [];

        //Recuperar del input oculto
        if(tangsInputHidden.value !== ''){
            tags = tangsInputHidden.value.split(',');
            mostrarTags();
        }

        //Escuchas los cambios en el input de los tags
        tagsInput.addEventListener('keypress', guardarTag);

        function guardarTag(evento){
            if(evento.keyCode === 44){
                if(evento.target.value.trim() === '' || evento.target.value < 1){
                    return; //De esta manera evitamos que nos puedan incluir espacios vacios o comas solamente
                }
                evento.preventDefault(); //Esto nos elimina la coma cuando limpiamos el input
                tags = [...tags, evento.target.value.trim()]
                tagsInput.value = '';
            }

            mostrarTags();
        }

        function mostrarTags(){
            //DOM Scripting
            tagsDiv.textContent = '';
            tags.forEach(tag=>{
                const etiqueta = document.createElement('LI');
                etiqueta.classList.add('formulario__tag');
                etiqueta.textContent = tag;
                etiqueta.ondblclick = eliminarTag;
                tagsDiv.appendChild(etiqueta);
            })
            
            actualizarInputHidden();
        }

        function eliminarTag(evento){
            evento.target.remove();
            tags = tags.filter(tag => tag !== evento.target.textContent);
            actualizarInputHidden();
        }

        function actualizarInputHidden(){
            tangsInputHidden.value = tags.toString();
        }
    }
    
})()