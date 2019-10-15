<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

// use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A type',
        'model' => User::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of user'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of user'
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The email of user'
            ],
            'user_profile' => [
                'type' => GraphQL::type('User_profile'),
                'description' => 'The profile of user profile'
            ],
            'products' => [
                'type' => Type::listOf(GraphQL::type('Product')),
                'description' => 'These product which is had by user'
            ]
        ];
    }
}
