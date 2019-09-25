<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Transaction;

class TransactionTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Transaction $transaction)
    {
        return [
            'identifier' =>    (int)$transaction->id,
            'quantity' =>      (int)$transaction->quantity,
            'buyer' =>         (int)$transaction->buyer_id,
            'product' =>       (int)$transaction->product_id,
            'creation_date' => (string)$transaction->created_at,
            'last_change'  =>  (string)$transaction->updated_at,
            'deletion_date'  => isset($transaction->deleted_at) ? (string)$transaction->deleted_at : null,

            'links' => 
            [
                [
                    'rel' => 'self',
                    'href' => route('transactions.show', $transaction->id),
                ],
                [
                    'rel' => 'transaction.category',
                    'href' => route('transactions.categories.index', $transaction->id),
                ],
                [
                    'rel' => 'transaction.seller',
                    'href' => route('transactions.sellers.index', $transaction->id),
                ],
                [
                    'rel' => 'transaction.buyer',
                    'href' => route('buyers.show', $transaction->buyer_id),
                ],
                [
                    'rel' => 'transaction.product',
                    'href' => route('products.show', $transaction->product_id),
                ],
            ],
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes =  [
            'identifier'   => "id",
            'quantity' => "quantity",
            'buyer' => "buyer_id",
            'product' => "product_id",
            'creation_date'  => "created_at",
            'last_change'  => "updated_at",
            'deletion_date'  => "deleted_at",
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function tranformedAttribute($index)
    {
        $attributes =  [
             "id" => 'identifier',
             "quantity" => 'quantity',
             "buyer_id" => 'buyer',
             "product_id" => 'product',
             "created_at" => 'creation_date',
             "updated_at" => 'last_change',
             "deleted_at" => 'deletion_date',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
