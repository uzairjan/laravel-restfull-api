<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Buyer;

class BuyerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Buyer $buyer)
    {
        return [
            'identifier' => (int)$buyer->id,
            'title' => (string)$buyer->name,
            'email' => (int)$buyer->email,
            'is_verified' => (int)$buyer->verified,
            'creation_date'  => (string)$buyer->created_at,
            'last_change'  => (string)$buyer->updated_at,
            'deletion_date'  => isset($buyer->deleted_at) ? (string)$buyer->deleted_at : null,
            'links' =>
            [
                [
                    'rel' => 'self',
                    'href' => route('buyers.show', $buyer->id),
                ],
                [
                    'rel' => 'buyer.categories',
                    'href' => route('buyers.categories.index', $buyer->id),
                ],
                [
                    'rel' => 'buyer.products',
                    'href' => route('buyers.products.index', $buyer->id),
                ],
                [
                    'rel' => 'buyer.sellers',
                    'href' => route('buyers.sellers.index', $buyer->id),
                ],
                [
                    'rel' => 'buyer.transactions',
                    'href' => route('buyers.transactions.index', $buyer->id),
                ],
                [
                    'rel' => 'buyer.profile',
                    'href' => route('users.show', $buyer->id),
                ]
            ]
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes =  [
            'identifier'   => "id",
            'title'        => "name",
            'email'        => "email",
            'is_verified'  => "verified",
            'creation_date'  => "created_at",
            'last_change'  => "updated_at",
            'deletion_date'  => "deleted_at",
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes =  [
            "id" => "identifier",
            "name" => "title",
            "email" => "email",
            "verified" => "is_verified",
            "created_at" => "creation_date",
            "updated_at" => "last_change",
            "deleted_at" => "deletion_date",
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
