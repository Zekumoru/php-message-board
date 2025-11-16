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

- PHP 8.x (Docker: `php:8.x-apache`)
- MySQL (Docker: `mysql:8.0`)
- HTML5 & CSS3
- Docker & Docker Compose (ambiente consigliato)
- MAMP (solo come alternativa locale)

## 📦 Installazione

### 🔹 Clone del repository

```bash
git clone git@github.com:Zekumoru/php-message-board.git
cd php-message-board
```

## 🔹 Avvio con Docker (raccomandato)

Il progetto include un setup completo Docker (PHP + Apache + MySQL).

1. Crea un file `.env` nella root del progetto con il seguente contenuto:

    ```bash
    DB_HOST=db
    DB_USER=admin
    DB_PASS=root
    DB_NAME=php_message_board
    ```

    I parametri vengono poi letti automaticamente da docker-compose.yml e dal file conn.php.

2. Avviare i container:

    ```bash
    docker compose up -d
    ```

3. Apri l’applicazione:

    ```bash
    http://localhost:8080
    ```

4. Per accedere al database dalla shell:

    ```bash
    docker exec -it message_board_db mysql -u root -p
    ```

### 🔹 Avvio con MAMP (opzionale)

1. Sposta la cartella del progetto in:

    ```bash
    /Applications/MAMP/htdocs/
    ```

2. Assicurati che `db/conn.php` sia configurato con host, utente e password corretti.

    Questo file **crea automaticamente** il database e la tabella alla prima esecuzione.

3. Apri:

    ```bash
    http://message-board.local
    ```

    (Oppure `http://localhost/message-board` se non usi vhost.)

## 📜 Licenza

Progetto per scopi didattici.
