<?php
// app/GraphQL/Query/TalentsQuery.php
namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\Talent;

class TalentsQuery extends Query {
  protected $attributes = [
    'name' => 'talents',
  ];

  public function type() {
    return Type::listOf(GraphQL::type('Talent'));
  }

  public function resolve($root, $args) {
    return Talent::all();
  }
}
