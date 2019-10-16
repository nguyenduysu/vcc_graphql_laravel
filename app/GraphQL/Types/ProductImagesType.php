<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\ProductImage;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ProductImagesType extends GraphQLType
{
    protected $attributes = [
        'name' => 'ProductImages',
        'description' => 'A type',
        'model' => ProductImage::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => "The id of images's product" 
            ],
            'image' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The image of product'
            ],
            'product' => [
                'type' => Type::nonNull(GraphQL::type('Product')),
                'description' => 'The product that have this image'
            ]
                
        ];
    }
}
