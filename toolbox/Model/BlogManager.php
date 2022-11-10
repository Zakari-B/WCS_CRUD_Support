<?php

namespace App\Model;

use PDO;

class BlogManager extends AbstractManager
{
    public const TABLE = 'article';

    public function selectOneByIdWithAuthor(int $id): array|false
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT source.id, source.title, source.content, u.name as author FROM " . self::TABLE . " as source INNER JOIN `user` as u ON u.id=source.user_id WHERE source.id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function insert(array $item): int
    {
        // ATTENTION : Système d'authentification requis pour aller chercher le user_id.
        // Ici, on met une valeur de 1 (correspondant à l'admin) lorsque le user_id n'existe pas pour pouvoir tester
        // que notre route fonctionne. Il faudra supprimer cette condition lorsqu'on aura implémenté une session.
        if (!isset($item['user_id'])) {
            $item['user_id'] = 1;
        }
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`title`, `content`, `user_id`) VALUES (:title, :content, :userid)");
        $statement->bindValue('title', $item['title'], PDO::PARAM_STR);
        $statement->bindValue('content', $item['content'], PDO::PARAM_STR);
        $statement->bindValue('userid', $item['user_id'], PDO::PARAM_INT);

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
