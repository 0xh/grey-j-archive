<?php
// app/GraphQL/Query/CharacterClassesQuery.php
namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\CharacterClass;

class CharacterClassesQuery extends Query {
  protected $attributes = [
    'name' => 'character_classes',
  ];

  public function type() {
    return Type::listOf(GraphQL::type('CharacterClass'));
  }

  public function resolve($root, $args) {
    return CharacterClass::all();
  }
}
