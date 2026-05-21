<?php

$messagesFile = "data/messages.json";
$messages = [];

if (file_exists($messagesFile)) {
    $messages = json_decode(file_get_contents($messagesFile), true);

    if (!is_array($messages)) {
        $messages = [];
    }
}

$messages = array_reverse($messages);
$status = $_GET["status"] ?? "";

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Duo Blog Web</title>
</head>

<body>
    <p class="head-text-p-hero">
        <span class="head-text-p-hero-span">Mini Proyecto de Programación</span>
    </p>

    <main>

        <!-- Título de contenido del hero -->
        <section class="content-title-hero">
            <h2 class="content-title-hero-h2-part-1">BLOG</h2>
            <h1 class="content-title-hero-h1-part-2">DUO</h1>
        </section>

        <!-- Descripción del contenido del hero -->
        <section class="description-content-duo">
            <p class="text-description-about-duo">Dos voces. Un mismo código.</p>
            <p class="text-menor-description-names-partners">Kairo & Juanes</p>
        </section>
        <hr>

        <!-- Sección de enlance a cada uno -->
        <section class="links-content-duo">
            <a href="partners/kairo/kairo_init_.php" class="link-partner-kairo">Conocer a Kairo</a>
            <a href="partners/juanes/juanes_init_.php" class="link-partner-juanes">Conocer a Juanes</a>
        </section>

        <!-- Sección del formulario -->
        <section id="guestbook" class="guestbook-section">
            <h2>Libro de visitas</h2>
            <p>Déjanos tu nombre y un mensaje para nuestro blog.</p>

            <?php if ($status === "success"): ?>
                <p class="success-message">Mensaje guardado correctamente.</p>
            <?php elseif ($status === "error"): ?>
                <p class="error-message">Debes completar todos los campos.</p>
            <?php endif; ?>

            <form action="php/guestbook.php" method="POST" class="guestbook-form">
                <input
                    type="text"
                    name="name"
                    placeholder="Tu nombre"
                    maxlength="50"
                    required>

                <textarea
                    name="message"
                    placeholder="Escribe tu mensaje"
                    maxlength="300"
                    required></textarea>

                <button type="submit">Enviar mensaje</button>
            </form>

            <div class="messages-container">
                <h3>Mensajes recientes</h3>

                <?php if (empty($messages)): ?>
                    <p>Aún no hay mensajes.</p>
                <?php else: ?>
                    <?php foreach ($messages as $item): ?>
                        <article class="message-card">
                            <h4><?= $item["name"] ?></h4>
                            <p><?= $item["message"] ?></p>
                            <small><?= $item["date"] ?></small>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>

    </main>
</body>

</html>