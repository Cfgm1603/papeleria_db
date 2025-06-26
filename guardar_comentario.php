<?php
// guardar_comentario.php

// Conexión a la base de datos
$host = 'localhost';
$db   = 'papeleria_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
  $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
  die("❌ Error de conexión: " . $e->getMessage());
}

// Obtener y sanitizar datos del formulario
$nombre     = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
$telefono   = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
$correo     = filter_input(INPUT_POST, 'correo', FILTER_VALIDATE_EMAIL);
$servicio   = filter_input(INPUT_POST, 'servicio', FILTER_SANITIZE_STRING);
$comentario = filter_input(INPUT_POST, 'comentario', FILTER_SANITIZE_STRING);

if (!$nombre || !$telefono || !$correo || !$servicio || !$comentario) {
  die("❌ Por favor completa todos los campos correctamente.");
}

// Insertar datos en la base de datos
$sql = "INSERT INTO comentarios (nombre, telefono, correo, servicio, comentario) VALUES (?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$nombre, $telefono, $correo, $servicio, $comentario]);

// Prepara el mensaje de agradecimiento según el servicio recibido
$servicioLower = strtolower($servicio);
$mensajes = [
  'excelente' => "🌟 ¡Nos alegra saber que tu experiencia fue excelente! Gracias por confiar en nosotros.",
  'bueno'     => "👍 Gracias por tu valoración positiva. Seguiremos trabajando para mejorar aún más.",
  'regular'   => "🤔 Agradecemos tu opinión. Trabajaremos para que la próxima vez tu experiencia sea mejor.",
  'malo'      => "😞 Lamentamos que no hayas quedado satisfecho. Tu opinión es muy importante para mejorar.",
  'pésimo'    => "😢 Sentimos mucho que tu experiencia haya sido pésima. Estamos comprometidos a cambiar eso.",
];
$mensajeMostrar = $mensajes[$servicioLower] ?? "📩 Gracias por comunicarte con nosotros. Nos pondremos en contacto contigo pronto.";
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>💌 ¡Gracias por tu mensaje!</title>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=UnifrakturCook&display=swap" rel="stylesheet" />
  <style>
    body {
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #1a1a1a, #3a332f);
      font-family: 'Cinzel', serif;
      color: #d6c9b8;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      text-align: center;
      overflow: hidden;
    }
    .container {
      background-color: #2e2720;
      padding: 40px 50px;
      border-radius: 20px;
      border: 3px solid #6b5b3c;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.8);
      max-width: 600px;
      font-size: 20px;
      line-height: 1.5;
      color: #c9b58f;
      font-family: 'Cinzel', serif;
      user-select: none;
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 0.8s ease, transform 0.8s ease;
    }
    .container.visible {
      opacity: 1;
      transform: translateY(0);
    }
    h1 {
      font-family: 'UnifrakturCook', cursive;
      font-size: 38px;
      margin-bottom: 25px;
      color: #b79967;
      text-shadow: 2px 2px 6px #3e2f1c;
    }
    p {
      margin-bottom: 30px;
      text-shadow: 1px 1px 3px #4a3f2a;
      min-height: 80px;
      font-style: italic;
    }
    a.volver {
      display: inline-block;
      padding: 14px 28px;
      background-color: #6b5b3c;
      color: #d6c9b8;
      text-decoration: none;
      border-radius: 12px;
      font-weight: 700;
      font-family: 'Cinzel', serif;
      font-size: 18px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.9);
      transition: background-color 0.3s ease, color 0.3s ease;
      user-select: none;
    }
    a.volver:hover {
      background-color: #b79967;
      color: #3a332f;
      box-shadow: 0 6px 20px #b79967;
    }
  </style>
</head>
<body>
  <div class="container" id="container">
    <h1>💖 ¡Gracias por tu mensaje!</h1>
    <p id="mensaje"><?php echo htmlspecialchars($mensajeMostrar); ?></p>
    <a href="index.html" class="volver" title="Volver al inicio">🏠 Volver al inicio</a>
  </div>

  <script>
    window.addEventListener("DOMContentLoaded", () => {
      document.getElementById("container").classList.add("visible");
    });
  </script>
</body>
</html>
