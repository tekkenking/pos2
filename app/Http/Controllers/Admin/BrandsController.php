<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BaseController;

use App\Jobs\toggleStatus as jobToggleStatus;
use App\Libs\Repos\BrandRepo;

class BrandsController extends BaseController
{
    public $brandRepo;

    public function __construct(BrandRepo $brandrepo)
    {
        parent::__construct();
        $this->brandRepo = $brandrepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data['brands'] = $this->brandRepo->allWithCategories();
        $data['pagetitle'] = 'Manage stock brands';
        return view('admin.stocks.brands.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.stocks.brands.modals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $newBrandsArray = $request->get('brands');
        //tt($newBrandsArray);

        if( $newBrandsArray == null ){
            return \Ajaxalert::error('Brands list can not be empty')->get();
        }

        $newBrandsArray = change_array_case($newBrandsArray, 'lowercase');
        $existingBrands = $this->brandRepo->model->lists('name')->toArray();

        if( !empty($existingBrands) )
        {
            $existingBrands = change_array_case($existingBrands, 'lowercase');
        }

        $founded = [];
        $toStore = [];
        foreach( $newBrandsArray as $key => $value )
        {   
            $value = clean_string($value);

            if( in_array($value, $existingBrands) )
            {
                $founded[] = '* ' . $value;
            }else{
                $toStore[]['name'] = $value;
            }
        }

        //Lets save if any remains
        if( !empty($toStore) )
        {
            $this->brandRepo->multiInsert($toStore);
        }

        if( !empty($founded) && !empty($toStore) ){
            $existing = implode(', ', $founded);
            return \Ajaxalert::warning('Created successfully. <hr> The following are exisiting brands:<br>')
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    /*public function show($id)
    {   

    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $data['brand'] = $this->brandRepo->find($id);
        return view('admin.stocks.brands.modals.edit', $data);
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
        $changed = clean_string($request->get('name'));
        $this->brandRepo->update($id, ['name' => $changed]);
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
        $this->brandRepo->delete($id);
        return \Ajaxalert::success('Deleted successfully!')->get();
    }

    /*public function toggleStatus($id, $status)
    {
        $brand = $this->brandRepo->find($id);
        $this->dispatch(new jobToggleStatus($brand, $this->brandRepo, $status));
        return \Ajaxalert::lite()->get();
        
    }*/
}
