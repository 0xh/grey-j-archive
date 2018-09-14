<?php
// app/GraphQL/Type/TalentTreeType.php
namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class TalentTreeType extends GraphQLType {
    protected $attributes = [
        'name' => 'TalentTree',
        'description' => 'A Talent Tree'
    ];
    
    public function fields() {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of a Talent Tree',
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'The title of a Talent Tree',
            ],
            'slug' => [
                'type' => Type::string(),
                'description' => 'The slug of a Talent Tree',
            ],
            'class' => [
                  'type' => Type::string(),
                  'description' => 'The slug of the character class to which the talent tree primarily belongs',
            ],
            'book' => [
                  'type' => Type::string(),
                  'description' => 'The slug of the book where the Talent Tree is described',
            ],
            'page' => [
                 'type' => Type::int(),
                 'description' => 'The page number where the TalentTree is described',
            ],
        ];
    }
}
