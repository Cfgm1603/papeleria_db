<?php
// Obtener y sanear el parámetro "servicio"
$servicio = isset($_GET['servicio']) ? strtolower(trim($_GET['servicio'])) : '';

$mensajes = [
  'excelente' => "🌟 ¡Nos alegra saber que tu experiencia fue excelente! Gracias por confiar en nosotros.",
  'bueno'     => "👍 Gracias por tu valoración positiva. Seguiremos trabajando para mejorar aún más.",
  'regular'   => "🤔 Agradecemos tu opinión. Trabajaremos para que la próxima vez tu experiencia sea mejor.",
  'malo'      => "😞 Lamentamos que no hayas quedado satisfecho. Tu opinión es muy importante para mejorar.",
  'pésimo'    => "😢 Sentimos mucho que tu experiencia haya sido pésima. Estamos comprometidos a cambiar eso.",
];

$mensajeMostrar = $mensajes[$servicio] ?? "📩 Gracias por comunicarte con nosotros. Nos pondremos en contacto contigo pronto.";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>💌 ¡Gracias por tu mensaje!</title>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=UnifrakturCook&display=swap" rel="stylesheet" />
  <style>
    /* Aquí el CSS que ya tienes */
    /* ... */
  </style>
</head>
<body>
  <div class="container" id="container">
    <h1>💖 ¡Gracias por tu mensaje!</h1>
    <p id="mensaje"><?= htmlspecialchars($mensajeMostrar) ?></p>
    <a href="index.html" class="volver" title="Volver al inicio">🏠 Volver al inicio</a>
  </div>
  <script>
    window.addEventListener("DOMContentLoaded", () => {
      document.getElementById("container").classList.add("visible");
    });
  </script>
</body>
</html>
