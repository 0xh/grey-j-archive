<?php
// app/GraphQL/Type/CharacterClassType.php
namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class CharacterClassType extends GraphQLType {
    protected $attributes = [
        'name' => 'CharacterClass',
        'description' => 'A character class'
    ];
    
    public function fields() {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of a character class',
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'The title of a character class',
            ],
            'slug' => [
                'type' => Type::string(),
                'description' => 'The slug of a character class',
            ],
            'book' => [
                  'type' => Type::string(),
                  'description' => 'The slug of the book where the character class is described',
            ],
            'page' => [
                 'type' => Type::int(),
                 'description' => 'The page number where the character class is described',
            ],
            'prerequisities' => [
                'type' => Type::string(),
                'description' => 'The prerequisities, if any, to take a level in the character class',
            ],
        ];
    }
}
