<?php

namespace App\Model;

use PDO;

class BlogManager extends AbstractManager
{
    public const TABLE = 'article';

    public function insert(array $item): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`title`, `content`) VALUES (:title, :content)");
        $statement->bindValue('title', $item['title'], PDO::PARAM_STR);
        $statement->bindValue('content', $item['content'], PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function update(array $item): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title, `content` = :content WHERE id=:id");
        $statement->bindValue('id', $item['id'], PDO::PARAM_INT);
        $statement->bindValue('title', $item['title'], PDO::PARAM_STR);
        $statement->bindValue('content', $item['content'], PDO::PARAM_STR);

        return $statement->execute();
    }
}
