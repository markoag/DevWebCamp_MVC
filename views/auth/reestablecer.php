<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Ingresa tu Nueva Contraseña de DevWebcamp</p>

    <?php require_once __DIR__ . '/../templates/alertas.php'; ?>

    <?php if ($token_valido) { ?>

        <form class="formulario" method="POST">
            <div class="formulario__campo">
                <label for="password" class="formulario__label">Nueva Contraseña</label>
                <input type="password" class="formulario__input" name="password" id="password" placeholder="Tu Contraseña">
            </div>
            <div class="formulario__campo">
                <label for="password2" class="formulario__label">Repetir Contraseña</label>
                <input type="password" class="formulario__input" name="password2" id="password2"
                    placeholder="Repite tu Contraseña">
            </div>

            <input type="submit" class="formulario__submit" value="Recuperar Contraseña">
        </form>

    <?php } ?>

    <div class="acciones--centrar">
        <a href="/login" class="acciones__enlace">Inicia Sesión</a>
    </div>

</main>