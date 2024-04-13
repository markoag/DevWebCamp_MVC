<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Recupera tu contraseña de DevWebcamp</p>

    <?php require_once __DIR__ . '/../templates/alertas.php'; ?>

    <form class="formulario" method="POST" action="/olvide">
        <div class="formulario__campo">
            <label for="email" class="formulario__label">E-mail</label>
            <input type="email" class="formulario__input" name="email" id="email" placeholder="Tu E-mail"
                value="<?php echo s($usuario->email); ?>">
        </div>
        
        <input type="submit" class="formulario__submit" value="Enviar Instrucciones">
    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">Inicia Sesión</a>
        <a href="/registro" class="acciones__enlace">Crea una cuenta!</a>
    </div>

</main>