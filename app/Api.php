<?php

declare (strict_types=1);

namespace App;

use App\Models\Article;
use Dotenv\Dotenv;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Api
{
    private Client $client;

    private const API_URL = "https://newsapi.org/v2/";
    private string $apiKey;

    public function __construct()
    {
        $this->client = new Client([
            'verify' => false
        ]);
        $dotenv = Dotenv::createImmutable("../");
        $dotenv->load();
        $this->apiKey = $_ENV["NEWS_API_KEY"];
    }

    public function fetchLatestArticles(): array
    {
        $articles = [];
        $response = $this->client->get(self::API_URL . "top-headlines?apiKey=" . $this->apiKey . "&language=en");
        $data = json_decode((string)$response->getBody());
        //dd($data);
        foreach ($data->articles as $article)
            $articles[] = new Article(
                $article->title,
                $article->source->name,
                $article->author,
                $article->description,
                $article->content,
                $article->urlToImage,
                $article->publishedAt,
                $article->url
            );

        return $articles;
    }

    public function search(): array
    {
        $url = self::API_URL;
        $url .= "top-headlines?apiKey=" . $this->apiKey;
        if ($_GET["topic"] != "") {
            $url .= ("&q=" . $_GET["topic"]);
        }
        if ($_GET["country"] != "") {
            $url .= ("&country=" . $_GET["country"]);
        }
        if ($_GET["from"] != "") {
            $url .= "&from=" . $_GET["from"];
        }
        if ($_GET["to"] != "") {
            $url .= "&to=" . $_GET["to"];
        }
        $articles = [];
        try {
            $response = $this->client->get($url);
        } catch (GuzzleException $e) {
            return [];
        }
        $data = json_decode((string)$response->getBody());

        //dd($data);
        foreach ($data->articles as $article)
            $articles[] = new Article(
                $article->title,
                $article->source->name,
                $article->author,
                $article->description,
                $article->content,
                $article->urlToImage,
                $article->publishedAt,
                $article->url
            );

        return $articles;
    }
}
