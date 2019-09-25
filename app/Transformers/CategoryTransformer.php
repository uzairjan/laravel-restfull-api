<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Category;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Category $category)
    {
        return [
            'identifier' => (int)$category->id,
            'title' => (string)$category->name,
            'details' => (string)$category->description,
            'creation_date'  =>(string)$category->created_at,
            'last_change'  =>(string)$category->updated_at,
            'deletion_date'  => isset($category->deleted_at) ? (string)$category->deleted_at : null,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('categories.show', $category->id),
                ],[
                    'rel' => 'category.buyers',
                    'href' => route('categories.buyers.index', $category->id),
                ],[
                    'rel' => 'category.products',
                    'href' => route('categories.products.index', $category->id),
                ],[
                    'rel' => 'category.sellers',
                    'href' => route('categories.sellers.index', $category->id),
                ],[
                    'rel' => 'category.transactions',
                    'href' => route('categories.transactions.index', $category->id),
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
            "description" => "details",
            "created_at" => "creation_date",
            "updated_at" => "last_change",
            "deleted_at" => "deletion_date",
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
