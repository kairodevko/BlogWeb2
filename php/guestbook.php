<?php

$messagesFile = "../data/messages.json";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $message = trim($_POST["message"] ?? "");

    if ($name === "" || $message === "") {
        header("Location: ../index.php?status=error#guestbook");
        exit;
    }

    if (!file_exists($messagesFile)) {
        file_put_contents($messagesFile, "[]");
    }

    $messages = json_decode(file_get_contents($messagesFile), true);

    if (!is_array($messages)) {
        $messages = [];
    }

    $messages[] = [
        "name" => htmlspecialchars($name),
        "message" => htmlspecialchars($message),
        "date" => date("Y-m-d H:i:s")
    ];

    $saved = file_put_contents(
        $messagesFile,
        json_encode($messages, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );

    if ($saved === false) {
        die("Error: no se pudo guardar el mensaje en messages.json");
    }

    header("Location: ../index.php?status=success#guestbook");
    exit;
}

die("Este archivo solo funciona con POST desde el formulario.");