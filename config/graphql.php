<?php

declare(strict_types=1);

use App\GraphQL\Types\UserType;
use App\GraphQL\Types\UserProfileType;
use App\GraphQL\Types\ProductType;
use App\GraphQL\Types\ProductImagesType;

use App\GraphQL\Queries\AllUserQuery;
use App\GraphQL\Queries\UserByIdQuery;
use App\GraphQL\Queries\AllProductQuery;
use App\GraphQL\Queries\ProductByIdQuery;
use App\GraphQL\Queries\AllProductImagesQuery;

use App\GraphQL\Mutations\NewUserMutation;
use App\GraphQL\Mutations\UpdateUserMutation;

return [
    'prefix' => 'graphql',

    'routes' => '{graphql_schema?}',

    'controllers' => \Rebing\GraphQL\GraphQLController::class.'@query',

    'middleware' => [],

    'route_group_attributes' => [],
   
    'default_schema' => 'default',

    'schemas' => [
        'default' => [
            'query' => [
                'allUsers' => AllUserQuery::class,
                'userById' => UserByIdQuery::class,
                'allProducts' => AllProductQuery::class,
                'productById' => ProductByIdQuery::class,
                'allProductImages' => AllProductImagesQuery::class
            ],
            'mutation' => [
                'newUser' => NewUserMutation::class,
                'updateUser' => UpdateUserMutation::class
            ],
            'middleware' => [],
            'method'     => ['get', 'post'],
        ],
    ],

    'types' => [
        'User' => UserType::class,
        'User_profile' => UserProfileType::class,
        'Product' => ProductType::class,
        'Product_image' => ProductImagesType::class

    ],

    'lazyload_types' => false,

    // This callable will be passed the Error object for each errors GraphQL catch.
    // The method should return an array representing the error.
    // Typically:
    // [
    //     'message' => '',
    //     'locations' => []
    // ]
    'error_formatter' => ['\Rebing\GraphQL\GraphQL', 'formatError'],

    /*
     * Custom Error Handling
     *
     * Expected handler signature is: function (array $errors, callable $formatter): array
     *
     * The default handler will pass exceptions to laravel Error Handling mechanism
     */
    'errors_handler' => ['\Rebing\GraphQL\GraphQL', 'handleErrors'],

    // You can set the key, which will be used to retrieve the dynamic variables
    'params_key'    => 'variables',

    /*
     * Options to limit the query complexity and depth. See the doc
     * @ https://github.com/webonyx/graphql-php#security
     * for details. Disabled by default.
     */
    'security' => [
        'query_max_complexity'  => null,
        'query_max_depth'       => null,
        'disable_introspection' => false,
    ],

    /*
     * You can define your own pagination type.
     * Reference \Rebing\GraphQL\Support\PaginationType::class
     */
    'pagination_type' => \Rebing\GraphQL\Support\PaginationType::class,

    /*
     * Config for GraphiQL (see (https://github.com/graphql/graphiql).
     */
    'graphiql' => [
        'prefix'     => '/graphiql',
        'controller' => \Rebing\GraphQL\GraphQLController::class.'@graphiql',
        'middleware' => [],
        'view'       => 'graphql::graphiql',
        'display'    => env('ENABLE_GRAPHIQL', true),
    ],

    /*
     * Overrides the default field resolver
     * See http://webonyx.github.io/graphql-php/data-fetching/#default-field-resolver
     *
     * Example:
     *
     * ```php
     * 'defaultFieldResolver' => function ($root, $args, $context, $info) {
     * },
     * ```
     * or
     * ```php
     * 'defaultFieldResolver' => [SomeKlass::class, 'someMethod'],
     * ```
     */
    'defaultFieldResolver' => null,

    /*
     * Any headers that will be added to the response returned by the default controller
     */
    'headers' => [],

    /*
     * Any JSON encoding options when returning a response from the default controller
     * See http://php.net/manual/function.json-encode.php for the full list of options
     */
    'json_encoding_options' => 0,
];
