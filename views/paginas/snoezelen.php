<main class="snoezelen">
    <h2 class="snoezelen__encabezado"><?php echo $titulo; ?></h2>
    <p class="snoezelen__descripcion">Conoce que es Snoezelen App y que puede ofrecerte</p>

    <div class="snoezelen__grid">
        <div data-aos="<?php aos_animacion();?>" class="snoezelen__imagen">
            <picture>
                <source srcset="build/img/estimulacion.avif" type="image/avif">
                <source srcset="build/img/estimulacion.webp" type="image/webp">
                <img loading="lazy" width="200" height="300" src="build/img/estimulacion.jpeg" alt="imagen snoezelen">
            </picture>
        </div>
        <div data-aos="<?php aos_animacion();?>" class="snoezelen__contendido">
            <p class="snoezelen__texto">
            Nullam quis ipsum fermentum, porttitor turpis vitae, placerat dui. Curabitur non mollis quam. Aliquam aliquet eu lectus in laoreet. Integer eleifend fringilla metus, eu scelerisque elit cursus eu. Pellentesque eget turpis venenatis, fermentum augue nec, varius leo. Aenean a cursus sapiensollicitudin. 
            </p>
            <p class="snoezelen__texto">
            Mauris bibendum suscipit mollis. Aenean sed tellus eu nulla volutpat commodo vitae eget turpis. Cras nec commodo libero. Nam augue neque, tempor a facilisis blandit, imperdiet posuere lacus. Etiam tempus euismod scelerisque. Phasellus eget euismod tortor, a elementum justo. 
            </p>
            
        </div>
    </div>
</main>