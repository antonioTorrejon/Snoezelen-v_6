<header class="header">
    <div class="header__contenedor">
        <nav class="header__navegacion">
            <?php if(is_auth() && !is_admin()) { ?>
                <a href="/usuarios/index" class="header__enlace"><?php echo $_SESSION['nombre']. " " . $_SESSION['apellido']; ?></a>
                <form method="POST" action="/logout" class="header__enlace">
                    <input type="submit" value="Cerrar sesión" class="header__enlace">
                </form>
            <?php } else if(is_prof()) { ?>     
                <a href="/profesionales/index" class="header__enlace"><?php echo $_SESSION['nombre']. " " . $_SESSION['apellido']; ?></a>
                <form method="POST" action="/profesionales/logout-profesionales" class="header__enlace">
                    <input type="submit" value="Cerrar sesión" class="header__enlace">
                </form>
            <?php } else if(is_admin()) { ?>     
                <a href="/admin/dashboard" class="header__enlace"><?php echo $_SESSION['nombre']. " " . $_SESSION['apellido']; ?></a>
                <form method="POST" action="/logout" class="header__enlace">
                    <input type="submit" value="Cerrar sesión" class="header__enlace">
                </form>
            <?php } else { ?>
                <a href="/profesionales/login-profesionales" class="header__enlace">Profesionales</a>
                <a href="/login" class="header__enlace">Usuarios</a>
            <?php } ?>


        </nav>

        <div class="header__contenido">
            <a href="/">
                <h1 class="header__logo">Snoezelen</h1>
            </a>
            <p class="header__texto">Ayudando a los que más quieres</p>
        </div>
    </div>
</header>

<div class="barra">
    <div class="barra__contenido">
       <a href="/">
       <h2 class="barra__logo">Snoezelen</h2>
       </a>
       <nav class="navegacion">
            <a href="/snoezelen" class="navegacion__enlace <?php echo pagina_actual('/snoezelen') ? 'navegacion__enlace--actual' : '';?>" >¿Qué hacemos?</a>
            <a href="/disciplinas" class="navegacion__enlace <?php echo pagina_actual('/disciplinas') ? 'navegacion__enlace--actual' : '';?>" >Disciplinas</a>
            <a href="/profesionales/profesionales" class="navegacion__enlace <?php echo pagina_actual('/profesionales/profesionales') ? 'navegacion__enlace--actual' : '';?>" >Profesionales</a>
            <a href="/registrarse" class="navegacion__enlace <?php echo pagina_actual('/registrarse') ? 'navegacion__enlace--actual' : '';?>" >Registrarse</a>
       </nav>
    </div>
</div>