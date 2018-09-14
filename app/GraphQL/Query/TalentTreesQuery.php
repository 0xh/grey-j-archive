<?php
// app/GraphQL/Query/TalentTreesQuery.php
namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\TalentTree;

class TalentTreesQuery extends Query {
  protected $attributes = [
    'name' => 'talent_trees',
  ];

  public function type() {
    return Type::listOf(GraphQL::type('TalentTree'));
  }

  public function resolve($root, $args) {
    return TalentTree::all();
  }
}
