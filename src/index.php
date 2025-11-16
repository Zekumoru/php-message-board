<?php
// Includiamo i file condivisi per riutilizzare connessione, modelli e gestione errori senza duplicare codice.
require "db/conn.php";
require "utils/error.php";
require_once "models/Message.php";
require_once "repositories/MessageRepository.php";

// Il repository incapsula l'accesso al DB cosi' il resto dell'app non deve conoscere SQL.
$messageRepository = new MessageRepository($conn);

// Manteniamo gli ultimi valori del form per poterli ristampare insieme agli errori di validazione.
$name = '';
$text = '';
$messages = $messageRepository->findAllMessages();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Creiamo un DTO che pulisce e valida i campi di input prima di arrivare al DB.
    $messageDto = new CreateMessageDTO($_POST);
    $name = $messageDto->name;
    $text = $messageDto->text;

    // Evitiamo insert vuote con semplici controlli lato server.
    if (empty($name)) {
        $nameErr = "Il nome è obbligatorio";
    }

    if (empty($text)) {
        $textErr = "Il messaggio è obbligatorio";
    }

    // Se tutto e' valido persistiamo e facciamo redirect per prevenire il doppio submit del form.
    if (!isset($nameErr) && !isset($textErr)) {
        $messageRepository->insertOne($messageDto);
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Message Board</title>
</head>

<body>
    <div id="app">
        <div class="title-wrapper">
            <h1>Benvenuto nel Message Board!</h1>
            <p>Inizia a scrivere e condividere i tuoi pensieri su questa bacheca.</p>
        </div>

        <form class="form-container card" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
            <div class="form-control">
                <label for="name">Nome</label>
                <input type="text" class="input" id="name" name="name" value="<?= $name ?>" />
                <?= isset($nameErr) ? "<span class=\"error\">* $nameErr</span>" : '' ?>
            </div>

            <div class="form-control">
                <label for="message">Messaggio</label>
                <textarea type="text" class="input" id="text" name="text"><?= $text ?></textarea>
                <?= isset($textErr) ? "<span class=\"error\">* $textErr</span>" : '' ?>
            </div>

            <button type="submit" class="btn">Invia</button>
        </form>

        <div class="messages-card card">
            <h2>Messaggi Recenti</h2>

            <?php if (empty($messages)): ?>
                <p class="no-messages-label">Ancora nessun messaggio!</p>
            <?php else: ?>
                <ul class="messages-list">
                    <?php foreach ($messages as $message): ?>
                        <li class="message-item">
                            <div class="message-details">
                                <span class="message-author"><?= $message->name ?></span>
                                <span class="message-date"><?= $message->created_at->format("Y/m/d H:i") ?></span>
                            </div>
                            <p class="message-text"><?= $message->text ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

    </div>
</body>

</html>
