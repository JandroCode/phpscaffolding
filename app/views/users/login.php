<?php require_once __DIR__ . '/../layouts/header_index.php'; ?>

<h2>Iniciar sesión</h2>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

<form action="<?php echo BASE_URL; ?>/user/authenticate" method="POST">
    <label>Email:</label>
    <input type="email" name="email" required><br><br>

    <label>Contraseña:</label>
    <input type="password" name="password" required><br><br>

    <button type="submit">Entrar</button>
</form>

<p><a href="<?php echo BASE_URL; ?>/user/create">¿No tienes cuenta? Regístrate</a></p>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
