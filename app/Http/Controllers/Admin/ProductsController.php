<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BaseController;

use App\Libs\Repos\ProductRepo;
use App\Libs\Repos\ProductCategoryRepo;
use App\Libs\Repos\BrandRepo;
use App\Libs\Repos\ModeRepo;

class ProductsController extends BaseController
{
    public $productRepo;
    public $productCategoryRepo;

    public function __construct(ProductRepo $productRepo, ProductCategoryRepo $productCategoryRepo, ModeRepo $modeRepo, BrandRepo $brandRepo)
    {
        parent::__construct();
        $this->productRepo = $productRepo;
        $this->productCategoryRepo = $productCategoryRepo;
        $this->brandRepo = $brandRepo;
        $this->modeRepo = $modeRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($brandid, $catid)
    {
        $data['category'] = $this->brandRepo
                            ->withCategoryAndProducts($brandid, $catid);
                    tt($data);
        $data['modes'] = $this->modeRepo->allActive();
        
        //tt($data['mode']->toArray());
        $data['pagetitle'] = 'Product page';
        return view('admin.stocks.products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($catid)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
