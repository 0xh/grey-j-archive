<?php
// app/GraphQL/Query/FeatsQuery.php
namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\Feat;

class FeatsQuery extends Query {
  protected $attributes = [
    'name' => 'feats',
  ];

  public function type() {
    return Type::listOf(GraphQL::type('Feat'));
  }

  public function resolve($root, $args) {
    return Feat::all();
  }
}
