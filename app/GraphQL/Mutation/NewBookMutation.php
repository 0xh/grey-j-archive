<?php
// app/GraphQL/Mutation/NewBookMutation.php
namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\Book;

class NewBookMutation extends Mutation {
    protected $attributes = [
        'name' => 'newBook'
    ];
    
    public function type() {
        return GraphQL::type('Book');
    }
    
    public function args() {
        return [
            'title' => [
                'name' => 'title',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],
            'slug' => [
                'name' => 'slug',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],
        ];
    }
    
    public function resolve($root, $args) {
        $book = new Book();
        
        $book->title = $args['title'];
        $book->slug = $args['slug'];
        $book->save();
        
        return Book::find($book->id);
    }
}
