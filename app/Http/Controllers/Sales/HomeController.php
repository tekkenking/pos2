<?php

namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BaseController;
use Larasset;

class HomeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $css = [
            'bootstrap_plugin' => [
                'select_picker'  =>   'select_picker/select_picker.css',
            ]
        ];

        $js = [
            'bootstrap_plugin'  => [
                'select_picker'  =>   'select_picker/select_picker.js',
                'typeahead'      =>   'typeahead/typeahead.js'
            ]
        ];

        Larasset::start('header')
                    ->storecss($css)
                    ->css('select_picker');

        Larasset::start('footer')
                    ->storejs($js)
                    ->js('select_picker', 'typeahead');

        $data['pagetitle'] = 'Make sales';

        return view('sales.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
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
