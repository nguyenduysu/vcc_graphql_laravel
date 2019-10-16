<?php

declare(strict_types=1);

namespace App\GraphQL\Types;
use App\UserProfile;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserProfileType extends GraphQLType
{
    protected $attributes = [
        'name' => 'UserProfile',
        'description' => 'A type',
        'model' => UserProfile::class
    ];

    public function fields(): array
    {
        return [
            'first_name' => [
                'type' => Type::string(),
                'description' => 'The first name of user'
            ],
            'last_name' => [
                'type' => Type::string(),
                'description' => 'The last name of user' 
            ],
            'avatar' => [
                'type' => Type::string(),
                'description' => 'The link of avatar\' user'
            ]
        ];
        
    }
}
