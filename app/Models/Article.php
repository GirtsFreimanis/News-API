<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;

class Article
{
    private string $title;
    private string $source;
    private ?string $author;
    private ?string $description;
    private ?string $content;
    private string $imgUrl;
    private Carbon $publishedAt;

    public function __construct(
        string  $title,
        string  $source,
        ?string $author,
        ?string $description,
        ?string $content,
        ?string $imgUrl,
        string  $publishedAt
    )
    {
        $this->title = $title;
        $this->source = $source;
        $this->author = $author;
        $this->description = $description;
        $this->content = $content;

        if ($imgUrl == null) {
            $this->imgUrl = "/assets/360_F_562111583_AcmOoTH53BpjhEJZ1g9BzUejGbj8lMAQ.jpg";
        } else {
            $this->imgUrl = $imgUrl;
        }
        $this->publishedAt = Carbon::parse($publishedAt);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getImgUrl(): string
    {
        return $this->imgUrl;
    }

    public function getPublishedAt(): Carbon
    {
        return $this->publishedAt;
    }

}