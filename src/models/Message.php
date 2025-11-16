<?php

require_once __DIR__ . '/../utils/sanitize.php';

class Message
{
    // Proprietà tipizzate pubbliche: rendono auto-documentato l'oggetto e accessibile nei template senza getter.
    public function __construct(
        public int $id,
        public string $name,
        public string $text,
        public DateTime $created_at,
    ) {
    }

    // Metodo factory per trasformare una riga del DB in un oggetto ricco che controlliamo noi.
    public static function fromArray(array $row): self
    {
        return new self(
            (int) $row['id'],
            $row['name'],
            $row['text'],
            new DateTime($row['created_at']),
        );
    }
}

class CreateMessageDTO
{
    public string $name;
    public string $text;

    public function __construct(array $data)
    {
        // Il DTO filtra e normalizza i dati in ingresso cosi' il repository riceve sempre valori sicuri.
        $this->name = sanitize($data['name']);
        $this->text = sanitize($data['text']);
    }
}

class UpdateMessageDTO
{
    public string $name;
    public string $text;

    public function __construct(array $data)
    {
        // Riutilizziamo la stessa logica di sanitizzazione per gli update futuri.
        $this->name = sanitize($data['name']);
        $this->text = sanitize($data['text']);
    }
}
