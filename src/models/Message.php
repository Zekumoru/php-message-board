<?php

require_once __DIR__ . '/../utils/sanitize.php';

class Message
{
    // TODO: Explain these publics and the types (since PHP didn't use to have it)
    public function __construct(
        public int $id,
        public string $name,
        public string $text,
        public DateTime $created_at,
    ) {
    }

    // TODO: Explain why we need fromArray
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

// TODO: Explain what a DTO is
class CreateMessageDTO
{
    public string $name;
    public string $text;

    public function __construct(array $data)
    {
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
        $this->name = sanitize($data['name']);
        $this->text = sanitize($data['text']);
    }
}
