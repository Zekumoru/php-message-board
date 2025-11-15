<?php

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

    public function __construct(string $name, string $text)
    {
        $this->name = $name;
        $this->text = $text;
    }
}

class UpdateMessageDTO
{
    public string $name;
    public string $text;

    public function __construct(string $name, string $text)
    {
        $this->name = $name;
        $this->text = $text;
    }
}
