<?php
// Iniciar sesión
session_start();

// Verificar si el usuario viene de un registro exitoso
if (!isset($_SESSION['registered_email'])) {
    header("Location: registrarse.php");
    exit();
}

// Incluir conexión a la base de datos
require_once 'conexion.php';

// Obtener el email de la sesión
$email = $_SESSION['registered_email'];

// Consultar el nombre del usuario
try {
    $stmt = $pdo->prepare("SELECT nombre FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $nombre = $user ? htmlspecialchars($user['nombre']) : 'Usuario';
} catch (PDOException $e) {
    $nombre = 'Usuario'; // Fallback en caso de error
}

// Limpiar la sesión
unset($_SESSION['registered_email']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <title>Registro Exitoso - Jabones DR</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="imagenes/logo.jpg" style="width: 100px;" alt="Logo Jabones DR">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.html">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="catalogo.html">Catalogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Mis Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Acerca de Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contacto.html">Contacto</a>
                    </li>
                </ul>

                <nav class="navbar">
                    <form class="container-fluid justify-content-start">
                        <button class="btn btn-outline-custom me-2" type="button">Iniciar Sesión</button>
                        <button class="btn btn-outline-custom me-2" type="button">Registrarse</button>
                    </form>
                </nav>  

                <ul class="nav-item">
                    <a class="nav-link" href="carro de compras.html">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                        </svg>
                    </a>
                </ul>
            </div>
        </div>
    </nav>
    <section class="success-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-sm-10 text-center">
                    <div class="card shadow-lg border-0 rounded">
                        <div class="card-body p-5">
                            <div class="check-circle mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="white" class="bi bi-check" viewBox="0 0 16 16">
                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                                </svg>
                            </div>
                            <h2 class="mb-3">¡Registro Exitoso, <?php echo $nombre; ?>!</h2>
                            <p class="mb-4">Utilice su correo y contraseña para iniciar sesión. Ahora puedes iniciar sesión en la página de inicio.</p>
                            <a href="index.html" class="btn btn-primary btn-success">Volver a la página de inicio</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="contact py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-9 m-auto text-center">
                    <h1>Te enviamos las mejores ofertas</h1>
                    <input type="text" class="px-3" placeholder="Ingresa tu correo">
                    <button class="btn2">Enviar</button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-3 py-3">
                            <h5 class="pb-3">Políticas</h5>
                            <p>Privacidad</p>
                            <p>Cookies</p>
                            <p>Legales</p>
                        </div>
                        <div class="col-lg-3 py-3">
                            <h5 class="pb-3">Entregas</h5>
                            <p>Puntuales</p>
                            <p>Contraentrega</p>
                            <p>En tienda</p>
                        </div>
                        <div class="col-lg-3 py-3">
                            <h5 class="pb-3">Ubicación</h5>
                            <p>Bosa Brasil</p>
                            <p>88c40 Cl. 51b sur</p>
                        </div>
                        <div class="col-lg-3 py-3">
                            <h5 class="pb-3">Redes Sociales</h5>
                            <img src="imagenes/red1.png" style="width: 50px;" alt="Facebook">
                            <img src="imagenes/red2.png" style="width: 50px;" alt="Instagram">
                            <img src="imagenes/red3.png" style="width: 50px;" alt="Twitter">
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <p class="text-center">Copyright @ 2025</p>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>