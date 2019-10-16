<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Closure;
use App\User;
use App\UserProfile;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class UpdateUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateUser',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('User');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::string()
            ],
            // 'first_name' => [
            //     'name' => 'first_name',
            //     'type' => Type::string()
            // ],
            // 'last_name' => [
            //     'name' => 'last_name',
            //     'type' => Type::string()            
            // ],
            // 'avatar' => [
            //     'name' => 'avatar',
            //     'type' => Type::string()                
            // ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        // $fields = $getSelectFields();
        // $select = $fields->getSelect();
        // $with = $fields->getRelations();

        // $user = new User;
        // $userProfile = new UserProfile;
        $user = User::find($args['id']);
        
        // $userProfile = UserProfile::where('user_id', $args['id'])->first();

        
        // if(!$args['name']) {
            // $user->name = $user->name;
        // } else {
            $user->name = $args['name'];
        // }

        // if(!$args['first_name']) {
        //     $userProfile->first_name = $userProfile->first_name;
        // } else {
            // $userProfile->first_name = $args['first_name'];
        // }

        // if(!$args['last_name']) {
        //     $userProfile->last_name = $userProfile->last_name;
        // } else {
            // $userProfile->last_name = $args['last_name'];
        // }

        // if(!$args['avatar']) {
        //     $userProfile->avatar = $userProfile->avatar;
        // } else {
            // $userProfile->avatar = $userProfile['avatar'];
        // }

        $user->save();
        // $userProfile->save();
        return $user;
    }
}
