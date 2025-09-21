<?php
return [
    'sources' => [
        'blogs' => [
            'model' => App\Models\Blog::class,
            'path' => 'app/Models/Blog.php',
            'table' => 'blogs',
            'fields' => ['title','description','content'],
            'route' => 'frontend.blogs.show',
            'param' => 'slug',
            'per_page' => 6,
            'has_published_scope' => true,
            'notes' => 'Model has `status` and `published_on`.'
        ],

        'videos' => [
            'model' => App\Models\Video::class,
            'path' => 'app/Models/Video.php',
            'table' => 'videos',
            'fields' => ['title','description'],
            'route' => 'frontend.videos.show',
            'param' => 'slug',
            'per_page' => 6,
            'has_published_scope' => true,
            'notes' => 'Guessed fields'
        ],

        'audios' => [
            'model' => App\Models\Audio::class,
            'path' => 'app/Models/Audio.php',
            'table' => 'audios',
            'fields' => ['title','description'],
            'route' => 'frontend.audios.show',
            'param' => 'slug',
            'per_page' => 6,
            'has_published_scope' => true,
            'notes' => 'Guessed fields'
        ],

        'fatawa' => [
            'model' => App\Models\Fatawa::class,
            'path' => 'app/Models/Fatawa.php',
            'table' => 'fatawa',
            'fields' => ['title','question','answer'],
            'route' => 'frontend.fatawas.show',
            'param' => 'slug',
            'per_page' => 6,
            'has_published_scope' => true,
            'notes' => 'Guessed fields'
        ],

        'books' => [
            'model' => App\Models\Book::class,
            'path' => 'app/Models/Book.php',
            'table' => 'books',
            'fields' => ['title','description','author'],
            'route' => 'frontend.books.show',
            'param' => 'slug',
            'per_page' => 6,
            'has_published_scope' => true,
            'notes' => 'Guessed fields'
        ],

        'durar' => [
            'model' => App\Models\DurarDiniya::class,
            'path' => 'app/Models/DurarDiniya.php',
            'table' => 'durar_diniya',
            'fields' => ['title','content'],
            'route' => 'frontend.durars.show',
            'param' => 'slug',
            'per_page' => 6,
            'has_published_scope' => true,
            'notes' => 'Guessed fields'
        ],
    ],
];