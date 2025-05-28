<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Ajusta la ruta según cómo tengas PHPMailer instalado
require 'vendor/autoload.php'; // ← si usaste Composer
// require 'PHPMailer/PHPMailer.php'; ← si lo hiciste manual

// Obtener los datos del formulario
$name = $_POST['Name'] ?? '';
$email = $_POST['Email'] ?? '';
$phone = $_POST['phone'] ?? '';
$message = $_POST['message'] ?? '';

// Validación rápida
if (empty($name) || empty($email) || empty($message)) {
    echo "Faltan campos requeridos.";
    http_response_code(400);
    exit;
}

$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';           // Cambia esto por tu servidor SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'weblunam@gmail.com';   // Tu correo Gmail
    $mail->Password = 'WeblunaM69!';      // App Password (NO tu contraseña normal)
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Remitente y destinatario
    $mail->setFrom($email, $name);
    $mail->addAddress('weblunam@gmail.com', 'Javier Enrique Luna Macias'); // Reemplaza con tu correo real

    // Contenido del mensaje
    $mail->isHTML(false);
    $mail->Subject = 'Nuevo mensaje desde el formulario web';
    $mail->Body = "Nombre: $name\nEmail: $email\nTeléfono: $phone\n\nMensaje:\n$message";

    $mail->send();
    echo "success";
} catch (Exception $e) {
    echo "Mailer Error: {$mail->ErrorInfo}";
    http_response_code(500);
}
?>
