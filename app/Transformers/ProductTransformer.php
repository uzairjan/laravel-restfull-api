<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Product;

class ProductTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            'identifier' => (int)$product->id,
            'title' => (string)$product->name,
            'details' => (string)$product->description,
            'stock' => (int)$product->quantity,
            'situation' => (string)$product->status,
            'picture' => url("img/{$product->image}"),
            'seller' => (int)$product->seller_id,
            'creation_date'  => (string)$product->created_at,
            'last_change'  => (string)$product->updated_at,
            'deletion_date'  => isset($product->deleted_at) ? (string)$product->deleted_at : null,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('products.show', $product->id),
                ],
                [
                    'rel' => 'product.buyers',
                    'href' => route('products.buyers.index', $product->id),
                ],
                [
                    'rel' => 'product.transactions',
                    'href' => route('products.buyers.index', $product->id),
                ],
                [
                    'rel' => 'product.categories',
                    'href' => route('products.categories.index', $product->id),
                ],
                [
                    'rel' => 'product.seller',
                    'href' => route('sellers.show', $product->seller_id),
                ],
            ],
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes =  [
            'identifier'   => "id",
            'title'        => "name",
            'details' => "description",
            'stock' => "quantity",
            'situation' => "status",
            'picture' => "image",
            'seller' => "seller_id",
            'creation_date'  => "created_at",
            'last_change'  => "updated_at",
            'deletion_date'  => "deleted_at",
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes =  [
            "id" => 'identifier',
            "name" => 'title',
            "description" => 'details',
            "quantity" => 'stock',
            "status" => 'situation',
            "image" => 'picture',
            "seller_id" => 'seller',
            "created_at" => 'creation_date',
            "updated_at" => 'last_change',
            "deleted_at" => 'deletion_date',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
