<?php
require 'conexion.php';

// Sanitizar y validar entrada
$nombre_cliente = filter_input(INPUT_POST, 'nombre_cliente', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
$direccion = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_STRING);
$carrito = $_POST['carrito'] ?? '';
$total = filter_input(INPUT_POST, 'total', FILTER_VALIDATE_FLOAT);

if (!$nombre_cliente || !$email || !$direccion || !$carrito || !$total) {
    die("Faltan datos obligatorios o datos inválidos. Por favor regresa y completa el formulario correctamente.");
}

// Insertar en base de datos
$stmt = $pdo->prepare("INSERT INTO pedidos (nombre_cliente, email, telefono, direccion, carrito, total) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->execute([$nombre_cliente, $email, $telefono, $direccion, $carrito, $total]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Pedido recibido - Papelería Mary</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Pacifico&family=Special+Elite&display=swap');

    body {
      font-family: 'Special Elite', monospace;
      background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
      color: #3e2c1c;
      max-width: 600px;
      margin: 40px auto;
      text-align: center;
      padding: 20px;
      box-shadow: 0 0 30px rgba(255, 160, 122, 0.6);
      border-radius: 20px;
    }

    h1 {
      font-family: 'Pacifico', cursive;
      color: #a52a2a;
      font-size: 2.8rem;
      margin-bottom: 15px;
      animation: zoomFadeIn 1s ease forwards;
      opacity: 0;
      transform: scale(0.8);
    }

    p {
      font-size: 1.2rem;
      margin: 10px 0;
      color: #5c3d2e;
      text-shadow: 1px 1px 2px rgba(255 255 255 / 0.6);
    }

    a {
      color: #ba8cb5;
      text-decoration: none;
      font-weight: bold;
      font-size: 1.1rem;
      display: inline-block;
      margin-top: 30px;
      padding: 10px 25px;
      border-radius: 12px;
      background-color: #f8c8dc;
      box-shadow: 2px 2px 8px rgba(186, 140, 181, 0.6);
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    a:hover {
      text-decoration: underline;
      background-color: #ba8cb5;
      color: #fffaf7;
      box-shadow: 3px 3px 12px rgba(186, 140, 181, 0.9);
    }

    @keyframes zoomFadeIn {
      to {
        opacity: 1;
        transform: scale(1);
      }
    }
  </style>
</head>
<body>
  <h1>¡Gracias por tu pedido, <?= htmlspecialchars($nombre_cliente) ?>!</h1>
  <p>Hemos recibido tu pedido correctamente.</p>
  <p>Nos pondremos en contacto contigo pronto para confirmar el pago y la entrega.</p>
  <p><a href="index.html">Volver al inicio</a></p>
</body>
</html>
