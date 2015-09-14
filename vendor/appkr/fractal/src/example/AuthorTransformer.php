<?php

namespace Appkr\Fractal\Example;

use League\Fractal;
use League\Fractal\TransformerAbstract;

class AuthorTransformer extends TransformerAbstract
{
    /**
     * Transform single resource
     *
     * @param \Appkr\Fractal\Example\Author $author
     * @return array
     */
    public function transform(Author $author)
    {
        return [
            'id'         => (int) $author->id,
            'name'       => $author->name,
            'email'      => $author->email,
            'created_at' => (int) $author->created_at->getTimestamp()
        ];
    }
}
