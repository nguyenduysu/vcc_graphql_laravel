<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Closure;
// use GraphQL;
use App\User;
use App\UserProfile;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class NewUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'newUser',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('User');
    }

    public function args(): array
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string())
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string())
            ], 
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string())
            ],
            'first_name' => [
                'name' => 'first_name',
                'type' => Type::nonNull(Type::string())
            ],
            'last_name' => [
                'name' => 'last_name',
                'type' => Type::nonNull(Type::string())
            ],
            'avatar' => [
                'name' => 'avatar',
                'type' => Type::nonNull(Type::string())
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        // $fields = $getSelectFields();
        // $select = $fields->getSelect();
        // $with = $fields->getRelations();

        // $args['password'] = bcrypt($args['password']);
        // $user = User::create($args);
        // if(!$user) {
        //     return null;
        // }
        // $user->user_profile()::create($args);
        // return $user;

        $user = new User;
        $user->name = $args['name'];
        $user->email = $args['email'];
        $user->password = bcrypt($args['password']);        
        $user->name = $args['name'];
        $user->save();
        
        $userProfile = new UserProfile;
        $userProfile->user_id = $user->id;
        $userProfile->first_name = $args['first_name'];
        $userProfile->last_name = $args['last_name'];
        $userProfile->avatar = $args['avatar'];
        
        $userProfile->save();
        return $user;

    }
}
