<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/admin/dashboard" class="dashboard__enlace <?php echo pagina_actual('/dashboard') ? 'dashboard__enlace--actual' : ''; ?>">
            <i class="fa-solid fa-house dashboard__icono"></i>
            <span class="dashboard__menu-texto">Inicio</span>
        </a>

        <a href="/admin/profesionales" class="dashboard__enlace <?php echo pagina_actual('/profesionales') ? 'dashboard__enlace--actual' : ''; ?>">
            <i class="fa-solid fa-user-tie dashboard__icono"></i>
            <span class="dashboard__menu-texto">Profesionales</span>
        </a>

        <a href="/admin/disciplinas" class="dashboard__enlace <?php echo pagina_actual('/disciplinas') ? 'dashboard__enlace--actual' : ''; ?>">
            <i class="fa-solid fa-stethoscope dashboard__icono"></i>
            <span class="dashboard__menu-texto">Disciplinas</span>
        </a>

        <a href="/admin/citas" class="dashboard__enlace <?php echo pagina_actual('/citas') ? 'dashboard__enlace--actual' : ''; ?>">
            <i class="fa-regular fa-calendar-xmark dashboard__icono"></i>
            <span class="dashboard__menu-texto">Citas</span>
        </a>

        <a href="/admin/registrados" class="dashboard__enlace <?php echo pagina_actual('/registrados') ? 'dashboard__enlace--actual' : ''; ?>">
            <i class="fa-solid fa-users dashboard__icono"></i>
            <span class="dashboard__menu-texto">Registrados</span>
        </a>

    </nav>
</aside>