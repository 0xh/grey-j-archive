<?php
// app/GraphQL/Type/FeatType.php
namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class FeatType extends GraphQLType {
    protected $attributes = [
        'name' => 'Feat',
        'description' => 'A feat'
    ];
    
    public function fields() {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of a feat',
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'The title of a feat',
            ],
            'slug' => [
                'type' => Type::string(),
                'description' => 'The slug of a feat',
            ],
            'book' => [
                  'type' => Type::string(),
                  'description' => 'The slug of the book where the feat is described',
            ],
            'page' => [
                 'type' => Type::int(),
                 'description' => 'The page number where the feat is described',
            ],
            'prerequisities' => [
                'type' => Type::string(),
                'description' => 'The prerequisities, if any, to take a feat',
            ],
            'short_description' => [
                'type' => Type::string(),
                'description' => 'The short description of a feat, suitable for inclusion in a table',
            ],
            'effect' => [
                'type' => Type::string(),
                'description' => 'The full rules text of a feat',
            ],
            'tags' => [
                'type' => Type::string(),
                'description' => 'Any tags that apply to a feat',
            ],
        ];
    }
}
