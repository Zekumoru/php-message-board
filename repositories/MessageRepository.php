<?php

require_once __DIR__ . '../models/Message.php';

class MessageRepository
{
    public function __construct(private PDO $conn)
    {
    }

    public function findById(int $id): ?Message
    {
        $stmt = $this->conn->prepare("SELECT * FROM messages WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        return Message::fromArray($row);
    }

    /**
     * @return Message[]
     */
    public function findAllMessages(): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM messages ORDER BY created_at DESC");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => Message::fromArray($row), $rows);
    }

    public function insertOne(CreateMessageDTO $message): bool
    {
        $stmt = $this->conn->prepare("INSERT INTO messages (name, text) VALUES (?, ?)");
        return $stmt->execute([$message->name, $message->text]);
    }

    public function updateOne(int $id, UpdateMessageDTO $message): bool
    {
        $stmt = $this->conn->prepare("UPDATE messages SET name = ?, message = ? WHERE id = ?");
        return $stmt->execute([$message->name, $message->text, $id]);
    }

    public function deleteOne(int $id): bool
    {
        $stmt = $this->conn->prepare("DELETE FROM messages WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
