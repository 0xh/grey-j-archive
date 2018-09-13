// database/factories/BookFactory.php

<?php

use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
    $book = [
        'title' => $faker->sentence,
    ];
    $words = [];
    preg_match_all('/[a-z]\w+/', strtolower($book['title']), $words);
    $book['slug'] = implode('', array_map(
        function($seg) { return $seg[0]; },
        $words[0]
    ));
    print_r([$book, $words]);
    return $book;
});
