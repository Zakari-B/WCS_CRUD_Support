<?php

namespace App\Controller;

use App\Model\BlogManager;

class BlogController extends AbstractController
{
    public function index(): string
    {
        $blogManager = new BlogManager();
        $articles = $blogManager->selectAll('title');

        return $this->twig->render('Blog/index.html.twig', ['articles' => $articles]);
    }

    public function show(int $id): string
    {
        $blogManager = new BlogManager();
        $article = $blogManager->selectOneByIdWithAuthor($id);

        return $this->twig->render('Blog/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * Edit a specific item
     */
    public function edit(int $id): ?string
    {
        $blogManager = new BlogManager();
        $article = $blogManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $article = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
            $blogManager->update($article);

            header('Location: /blog/show?id=' . $id);

            // we are redirecting so we don't want any content rendered
            return null;
        }

        return $this->twig->render('Blog/edit.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * Add a new item
     */
    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $article = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $blogManager = new BlogManager();
            $id = $blogManager->insert($article);

            header('Location:/blog/show?id=' . $id);
            return null;
        }

        return $this->twig->render('Blog/add.html.twig');
    }

    /**
     * Delete a specific item
     */
    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $blogManager = new BlogManager();
            $blogManager->delete((int)$id);

            header('Location:/blog');
        }
    }
}
