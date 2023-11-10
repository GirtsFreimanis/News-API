<?php

return [
    ['GET', '/', ['App\Controllers\ArticleController', 'index']],
    ['GET', '/show/{id:\d+}', ['App\Controllers\ArticleController', 'show']],
    ['GET', '/search', ['App\Controllers\SearchController', 'search']],

];