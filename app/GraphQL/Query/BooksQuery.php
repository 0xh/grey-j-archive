<?php
// app/GraphQL/Query/BooksQuery.php
namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\Book;

class BooksQuery extends Query {
  protected $attributes = [
    'name' => 'books',
  ];

  public function type() {
    return Type::listOf(GraphQL::type('Book'));
  }

  public function resolve($root, $args) {
    return Book::all();
  }
}
