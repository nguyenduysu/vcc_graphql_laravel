<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use App\User;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class AllUserQuery extends Query
{
    protected $attributes = [
        'name' => 'allUsers',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('User'));
    }

    public function args(): array
    {
        return [

        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        // if (!$user = User::find($args['id'])) {
        //     throw new \Exception('Resource not found');
        // }
        
        // if(! $user = User::where('id',$args['id'])->get() ) {
        //     throw new \Exception('Resource not found');
        // }

        $user = User::all();

        return $user;
    }
}
