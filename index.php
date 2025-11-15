<?php require "db/conn.php"; ?>
<?php require "utils/error.php"; ?>

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
        <?php
        require_once "models/Message.php";
        require_once "repositories/MessageRepository.php";

        $name = '';
        $text = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $messageRepository = new MessageRepository($conn);
            $messageDto = new CreateMessageDTO($_POST);
            $name = $messageDto->name;
            $text = $messageDto->text;

            if (empty($name)) {
                $nameErr = "Il nome è obbligatorio";
            }

            if (empty($text)) {
                $textErr = "Il messaggio è obbligatorio";
            }

            if (!isset($nameErr) && !isset($textErr)) {
                $messageRepository->insertOne($messageDto);
                $name = "";
                $text = "";
            }
        }
        ?>

        <div class="title-wrapper">
            <h1>Benvenuto nel Message Board!</h1>
            <p>Inizia a scrivere e condividere i tuoi pensieri su questa bacheca.</p>
        </div>

        <form class="form-container card" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
            <div class="form-control">
                <label for="name">Name</label>
                <input type="text" class="input" id="name" name="name" value="<?= $name ?>" />
                <?= isset($nameErr) ? "<span class=\"error\">* $nameErr</span>" : '' ?>
            </div>

            <div class="form-control">
                <label for="message">Message</label>
                <textarea type="text" class="input" id="text" name="text"><?= $text ?></textarea>
                <?= isset($textErr) ? "<span class=\"error\">* $textErr</span>" : '' ?>
            </div>

            <button type="submit" class="btn">Invia</button>
        </form>

        <div class="messages-card card">
            <h2>Messaggi Recenti</h2>

            <ul class="messages-list">
                <li class="message-item">
                    <div class="message-details">
                        <span class="message-author">Mario Rossi</span>
                        <span class="message-date">15/11/2025 19:12</span>
                    </div>
                    <p class="message-text">Ciao a tutti!</p>
                </li>

                <li class="message-item">
                    <div class="message-details">
                        <span class="message-author">Luca</span>
                        <span class="message-date">15/11/2025 19:12</span>
                    </div>
                    <p class="message-text">Buona giornata!</p>
                </li>
            </ul>
        </div>

    </div>
</body>

</html>