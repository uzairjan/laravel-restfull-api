<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Seller;

class SellerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Seller $seller)
    {
        return [
            'identifier' => (int)$seller->id,
            'title' => (string)$seller->name,
            'email' => (int)$seller->email,
            'is_verified' => (int)$seller->verified,
            'creation_date'  =>(string)$seller->created_at,
            'last_change'  =>(string)$seller->updated_at,
            'deletion_date'  => isset($seller->deleted_at) ? (string)$seller->deleted_at : null,
            'links' => 
            [
                [
                    'rel' => 'self',
                    'href' => route('sellers.show', $seller->id),
                ],
                [
                    'rel' => 'seller.buyers',
                    'href' => route('sellers.buyers.index', $seller->id),
                ],
                [
                    'rel' => 'seller.categories',
                    'href' => route('sellers.categories.index', $seller->id),
                ],
                [
                    'rel' => 'seller.products',
                    'href' => route('sellers.products.index', $seller->id)
                ],
                [
                    'rel' => 'seller.transactions',
                    'href' => route('sellers.transactions.index', $seller->id),
                ],
                [
                    'rel' => 'sellers.profile',
                    'href' => route('users.show', $seller->id),   
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
