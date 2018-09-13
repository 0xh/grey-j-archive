<?php
// app/GraphQL/Type/BookType.php
namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class BookType extends GraphQLType {
  protected $attributes = [
    'name' => 'Book',
    'description' => 'A sourcebook'
  ];

  public function fields() {
    return [
      'id' => [
        'type' => Type::nonNull(Type::int()),
        'description' => 'The id of a book',
      ],
      'title' => [
        'type' => Type::string(),
        'description' => 'The title of a book',
      ],
      'slug' => [
        'type' => Type::string(),
        'description' => 'The slug of a book',
      ],
    ];
  }
}
