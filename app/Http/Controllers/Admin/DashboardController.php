<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BaseController;
use Larasset;

class DashboardController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $js = [
            'inspinia_2.3/js/plugins' => [
                'chartjs'  =>  'chartJs/Chart.min.js'
            ]
        ];

        Larasset::start('footer')
            ->storeJs($js)
            ->js('chartjs');

        $data['pagetitle'] = 'Admin Dashboard';
        return view('admin.dashboard.index', $data);
    }

    public function salesOverview($time)
    {

    }

    public function hotSellingOverview($time)
    {

    }

    public function slowSellingOverview($time)
    {

    }

    private function carbonTime()
    {

    }
}
