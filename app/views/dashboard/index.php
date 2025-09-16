<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h2>Bienvenido al Dashboard Admin</h2>
<p>Hola, <?php echo htmlspecialchars($username); ?>!</p>

<p>Aquí puedes administrar la aplicación y ver estadísticas.</p>

<a href="<?php echo BASE_URL; ?>/user/logout">Cerrar sesión</a>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
