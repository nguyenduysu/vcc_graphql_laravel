<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use App\Product;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class ProductByIdQuery extends Query
{
    protected $attributes = [
        'name' => 'productById',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return GraphQL::type('Product');
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
        /** @var SelectFields $fields */
        // $fields = $getSelectFields();
        // $select = $fields->getSelect();
        // $with = $fields->getRelations();

        if(! $product = Product::find($args['id'])) {
            throw \Exception('Resource not found');
        }
        return $product;
    }
}
