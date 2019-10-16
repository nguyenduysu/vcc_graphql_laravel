<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Closure;
use App\User;
use App\UserProfile;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class DeleteUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteUser',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return Type::boolean();
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        // $fields = $getSelectFields();
        // $select = $fields->getSelect();
        // $with = $fields->getRelations();

        $user = User::find($args['id']);
        $userProfile = UserProfile::where('user_id', $args['id']);
        if (!$user) {
            throw new \Exception('Resource not found');
        }
        $user->delete();
        $userProfile->delete();

        return null;
        
    }
}
