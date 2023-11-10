<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Api;
use App\Response;

class SearchController
{
    private Api $api;

    public function __construct()
    {
        $this->api = new Api;
    }

    public function search(array $vars): Response
    {
        session_start();
        $articles = $this->api->search();
        if (empty($articles)) {
            return new Response(
                "articles/index",
                ["articles" => $this->api->fetchLatestArticles()]
            );
        }
        $_SESSION["articles"] = $articles;

        return new Response(
            "articles/index",
            ["articles" => $articles]
        );
    }
}