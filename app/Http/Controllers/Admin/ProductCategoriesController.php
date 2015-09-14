<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BaseController;

use App\Libs\Repos\BrandRepo;
use App\Libs\Repos\ProductCategoryRepo;

class ProductCategoriesController extends BaseController
{

    public function __construct(ProductCategoryRepo $categoryRepo, BrandRepo $brandrepo)
    {
        parent::__construct();
        $this->catRepo = $categoryRepo;
        $this->brandRepo = $brandrepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($brandid)
    { 
        $data['brand'] = $this->brandRepo->find($brandid);
        $data['categories'] = $this->brandRepo->byBrandIdWithCat($brandid);
       // tt($data['categories']);
        $data['pagetitle'] = $data['brand']->name;
        return view('admin.stocks.categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($brandid)
    {
        $data['brand'] = $this->brandRepo->find($brandid);
        return view('admin.stocks.categories.modals.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {   
        $cats = $request->get('cats');
        $brandid = $request->brand_id;
        $type = $request->type;

        if( $cats == null ){
            return \Ajaxalert::error('Categories list can not be empty')->get();
        }

        $cats = change_array_case($cats, 'lowercase');
        $existingCats = $this->catRepo->model->lists('name')->toArray();

        if( !empty($existingBrands) )
        {
            $existingCats = change_array_case($existingCats, 'lowercase');
        }

        $founded = [];
        $toStore = [];
        $counter = 0;
        foreach( $cats as $key => $value )
        {   
            $value = clean_string($value);

            if( in_array($value, $existingCats) )
            {
                $founded[] = '* ' . $value;
            }else{
                $toStore[$counter]['name'] = $value;
                $toStore[$counter]['brand_id'] = $brandid;
                if( $type != null ){  $toStore[$counter]['type'] = $type;  }
                $counter++;
            }
        }

        //Lets save if any remains
        if( !empty($toStore) )
        {
            $this->catRepo->multiInsert($toStore);
        }

        if( !empty($founded) && !empty($toStore) ){
            $existing = implode(', ', $founded);
            return \Ajaxalert::warning('Created successfully. <hr> The following are exisiting categories:<br>')
                    ->arrayMessage($founded)
                    ->icon('exclamation-triangle')
                    ->get();
        }

        if( !empty($founded) && empty($toStore) )
        {
            return \Ajaxalert::error($founded)->get();
        }

        if( empty($founded) && !empty($toStore) ){
            return \Ajaxalert::success('Created successfully')->get();
        }

        //$brand = $this->catRepo->created();
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
    public function edit($catid)
    {
        $data['cat'] = $this->catRepo->find($catid);
        return view('admin.stocks.categories.modals.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $catid)
    {
        $changed = clean_string($request->get('name'));
        $this->catRepo->update($catid, ['name' => $changed]);
        return \Ajaxalert::success('Updated successfully')->get();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->catRepo->delete($id);
        return \Ajaxalert::success('Deleted successfully!')->get();
    }
}
