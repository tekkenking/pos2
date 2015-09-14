<?php

namespace Appkr\Fractal\Example;

use League\Fractal;
use League\Fractal\TransformerAbstract;

class ResourceTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'author'
    ];

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'author'
    ];

    /**
     * Transform single resource
     *
     * @param \Appkr\Fractal\Example\Resource $resource
     * @return array
     */
    public function transform(Resource $resource)
    {
        return [
            'id'          => (int) $resource->id,
            'title'       => $resource->title,
            'description' => $resource->description,
            'deprecated'  => (bool) ($resource->deprecated == 1) ? true : false,
            'created_at'  => (int) $resource->created_at->getTimestamp()
        ];
    }

    /**
     * Include Author
     *
     * @param \Appkr\Fractal\Example\Resource $resource
     * @return \League\Fractal\Resource\Item|null
     */
    public function includeAuthor(Resource $resource)
    {
        $author = $resource->author;

        return $author
            ? $this->item($author, new AuthorTransformer)
            : null;
    }
}
