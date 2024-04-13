<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Crea tu cuenta en DevWebcamp</p>

    <?php require_once __DIR__ . '/../templates/alertas.php'; ?>

    <form class="formulario" method="POST" action="/registro">
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Tu Nombre"
                value="<?php echo s($usuario->nombre); ?>">
        </div>
        <div class="formulario__campo">
            <label for="apellido" class="formulario__label">Apellido</label>
            <input type="text" class="formulario__input" name="apellido" id="apellido" placeholder="Tu Apellido"
                value="<?php echo s($usuario->apellido); ?>">
        </div>
        <div class="formulario__campo">
            <label for="email" class="formulario__label">E-mail</label>
            <input type="email" class="formulario__input" name="email" id="email" placeholder="Tu E-mail"
                value="<?php echo s($usuario->email); ?>">
        </div>
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Contraseña</label>
            <input type="password" class="formulario__input" name="password" id="password" placeholder="Tu Contraseña">
        </div>
        <div class="formulario__campo">
            <label for="password2" class="formulario__label">Repetir Contraseña</label>
            <input type="password" class="formulario__input" name="password2" id="password2"
                placeholder="Repite tu Contraseña">
        </div>
        <input type="submit" class="formulario__submit" value="Crear Cuenta">
    </form>

    <div class="acciones--centrar">
        <p>¿Ya tienes una cuenta?</p><a href="/login" class="acciones__enlace">Inicia Sesión</a>
    </div>

</main>