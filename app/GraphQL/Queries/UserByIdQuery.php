<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\User;
use Closure;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class UserByIdQuery extends Query
{
    protected $attributes = [
        'name' => 'userById',
        'description' => 'A query'
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
                'type' => Type::int(),
                // 'rules' => ['required']
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::string()
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        if (!$user = User::find($args['id'])) {
            throw new \Exception('Resource not found');
        }

        return $user;

        // $where = function ($query) use ($args) {
        //     if (isset($args['id'])) {
        //         $query->where('id',$args['id']);
        //     }

        //     if (isset($args['email'])) {
        //         $query->where('email',$args['email']);
        //     }
        // };
        // $user = User::with(array_keys($fields->getRelations()))
        //     ->where($where)
        //     ->select($fields->getSelect())
        //     ->paginate();
        // return $user;
    }

    protected function resolveEmailField($root, $args) {
        return strtolower($root->name);
    }
}
