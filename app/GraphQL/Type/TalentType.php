<?php
// app/GraphQL/Type/TalentType.php
namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class TalentType extends GraphQLType {
    protected $attributes = [
        'name' => 'Talent',
        'description' => 'A Talent'
    ];
    
    public function fields() {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of a Talent',
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'The title of a Talent',
            ],
            'slug' => [
                'type' => Type::string(),
                'description' => 'The slug of a Talent',
            ],
            'tree' => [
                'type' => Type::string(),
                'description' => 'The slug of the tree to which this talent belongs',
            ],
            'book' => [
                  'type' => Type::string(),
                  'description' => 'The slug of the book where the Talent is described',
            ],
            'page' => [
                 'type' => Type::int(),
                 'description' => 'The page number where the Talent is described',
            ],
            'prerequisities' => [
                'type' => Type::string(),
                'description' => 'The prerequisities, if any, to take a Talent',
            ],
            'effect' => [
                'type' => Type::string(),
                'description' => 'The full rules text of a Talent',
            ],
        ];
    }
}
