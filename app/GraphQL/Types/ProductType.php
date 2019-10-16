<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Product;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ProductType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Product',
        'description' => 'A type',
        'model' => Product::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of product'
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'The title of product'
            ],
            'price' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The price of product'
            ],
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The description of product'
            ],
            'product_images' => [
                'type' => Type::listOf(GraphQL::type('Product_image')),
                'description' => 'These image of product'
            ],
            'user' => [
                'type' => Type::nonNull(GraphQL::type('User')),
                'description' => 'The user who have product'
            ]
        ];
    }
}
