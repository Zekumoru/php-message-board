# Message Board

Una semplice applicazione **Message Board** creata per esercitarmi con **PHP**, **MySQL** e **HTML**. Permette di inserire messaggi, visualizzarli e salvarli nel database.

## ✨ Funzionalità

- Inserimento di un nome e un messaggio tramite form
- Validazione dei campi
- Salvataggio dei messaggi in MySQL
- Visualizzazione dei messaggi ordinati dal più recente
- Timestamp formattato (`yyyy/MM/dd HH:mm`)
- Stile CSS minimale incluso

## 🛠 Tecnologie

- PHP 8.x
- MySQL
- HTML5 & CSS3
- MAMP (per sviluppo locale)

## 📦 Installazione

1. Clona il repository:

    ```bash
    git clone git@github.com:Zekumoru/php-message-board.git
    ```

2. Sposta la cartella dentro `MAMP/htdocs`.

3. Assicurati che `db/conn.php` (host, utente, password, database) sia configurato correttamente.

Questo file crea automaticamente il database e la tabella, quindi non serve nessun passaggio manuale.

## ▶️ Avvio

Apri il browser e vai su:

```bash
http://message-board.local
```

(o `http://localhost/message-board` se non usi vhost)

## 📜 Licenza

Progetto per scopi didattici.
