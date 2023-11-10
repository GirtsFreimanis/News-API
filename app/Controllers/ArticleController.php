<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Api;
use App\Response;

class ArticleController
{
    private Api $api;

    public function __construct()
    {
        $this->api = new Api();
    }

    public function index(): Response
    {
        session_start();
        $articles = $this->api->fetchLatestArticles();
        $_SESSION["articles"] = $articles;

        return new Response(
            "articles/index",
            [
                "articles" => $articles,
                "header" => "Latest news"
            ]
        );
    }

    public function show(array $vars): Response
    {
        session_start();

        $articles = $_SESSION["articles"];
        //session_abort();
        return new Response(
            "articles/show",
            ["article" => $articles[$vars["id"]]]
        );
    }
}