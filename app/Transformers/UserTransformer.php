<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'identifier' => (int)$user->id,
            'title' => (string)$user->name,
            'email' => (int)$user->email,
            'is_verified' => (int)$user->verified,
            'is_admin'  => ($user->admin === 'true'),
            'creation_date'  =>(string)$user-> created_at,
            'last_change'  =>(string)$user->updated_at,
            'deletion_date'  => isset($user->deleted_at) ? (string)$user->deleted_at : null,
            'links' => 
            [
                'rel' => 'self',
                'href' => route('users.show', $user->id),
            ],
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes =  [
            'identifier'   => "id",
            'title'        => "name",
            'email'        => "email",
            'is_verified'  => "verified",
            'is_admin'     => "admin",
            'creation_date'  => "created_at",
            'last_change'  => "updated_at",
            'deletion_date'  => "deleted_at",
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes =  [
             "id" =>  'identifier',
            "name" =>  'title',
            "email" =>  'email',
            "verified" =>  'is_verified',
            "admin" =>  'is_admin',
            "created_at" =>  'creation_date',
            "updated_at" =>  'last_change',
            "deleted_at" =>  'deletion_date',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
