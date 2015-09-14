<?php

namespace Appkr\Fractal\Example;

use App\Http\Controllers\Controller;
use Appkr\Fractal\Http\Response;

class ResourceController extends Controller
{

    /**
     * @var \Appkr\Fractal\Example\Resource
     */
    private $model;

    /**
     * @var \Appkr\Fractal\Http\Response
     */
    private $respond;

    /**
     * @param \Appkr\Fractal\Example\Resource $model
     * @param \Appkr\Fractal\Http\Response    $respond
     */
    public function __construct(Resource $model, Response $respond)
    {
        $this->model   = $model;
        $this->respond = $respond;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Http\Response
     */
    public function index()
    {
        // Respond with pagination
        return $this->respond->setMeta(['version' => 1])->withPagination(
            $this->model->with('author')->latest()->paginate(25),
            new ResourceTransformer
        );

        // Respond as a collection
        return $this->respond->setMeta(['version' => 1])->withCollection(
            $this->model->with('author')->latest()->get(),
            new ResourceTransformer
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ResourceRequest $request
     * @return \Illuminate\Contracts\Http\Response
     */
    public function store(ResourceRequest $request)
    {
        // Merging author_id. In real project
        // we should use $request->user()->id instead.
        $data = array_merge(
            $request->all(),
            ['author_id' => 1]
        );

        if (! $resource = Resource::create($data)) {
            return $this->respond->internalError('Failed to create !');
        }

        // respond created item with 201 status code
        return $this->respond->setStatusCode(201)->withItem(
            $resource,
            new ResourceTransformer
        );

        // respond with simple message
        return $this->respond->created('Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\Http\Response
     */
    public function show($id)
    {
        return $this->respond->setMeta(['version' => 1])->withItem(
            $this->model->findOrFail($id),
            new ResourceTransformer
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Appkr\Fractal\Example\ResourceRequest $request
     * @param int                                    $id
     * @return \Illuminate\Contracts\Http\Response
     */
    public function update(ResourceRequest $request, $id)
    {
        $resource = $this->model->findOrFail($id);

        if (! $resource->update($request->all())) {
            return $this->respond->internalError('Failed to update !');
        }

        return $this->respond->success('Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ResourceRequest $request
     * @param  int            $id
     * @return \Illuminate\Contracts\Http\Response
     */
    public function destroy(ResourceRequest $request, $id)
    {
        $resource = $this->model->findOrFail($id);

        if (! $resource->delete()) {
            return $this->respond->internalError('Failed to delete !');
        }

        return $this->respond->success('Deleted');
    }
}
