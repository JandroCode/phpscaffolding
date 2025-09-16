<?php require_once __DIR__ . '/../layouts/header_index.php'; ?>

<h1>Registrar nuevo usuario</h1>

<form action="<?php echo BASE_URL; ?>/user/store" method="POST">
    <label>Usuario:</label>
    <input type="text" name="username" required><br><br>

    <label>Email:</label>
    <input type="email" name="email" required><br><br>

    <label>Contraseña:</label>
    <input type="password" name="password" required><br><br>

    <button type="submit">Registrar</button>
</form>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
