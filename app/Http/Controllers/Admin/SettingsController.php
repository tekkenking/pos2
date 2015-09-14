<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BaseController;

use App\Libs\Repos\RoleRepo;
use App\Libs\Repos\UserRepo;

class SettingsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(UserRepo $userRepo)
    {

        $data['resultset'] = $userRepo->userWithRoleAndPermissions();
        $data['pagetitle'] = 'Admin Settings';
        return view('admin.settings.index', $data);
    }

    public function addRoleForm()
    {
        return view('admin.settings.modals.addroleform');
    }

    public function saveRole(Request $request, RoleRepo $roleRepo)
    {
        $all = $request->all();
        $status = $roleRepo->checkThenCreate($all);

        if( $status ){
            return \Ajaxalert::success('Created successfully!')
                ->icon('check fa-lg')
                ->get();
        }else{
            return \Ajaxalert::error($all['name'] . ' is already created!')
                ->icon('ban fa-lg')
                ->get();
        }
    }

    public function assignRoleForm($userid, Request $request, UserRepo $userRepo, RoleRepo $roleRepo)
    {
        $data['user_roles'] = $userRepo->listRoles($userid);
        //tt($data['user_roles']);
        $data['userid'] = $userid;
        $data['roles'] = $roleRepo->all(['id', 'name', 'slug']);
        return view('admin.settings.modals.assignroleform', $data);
    }

    public function saveAssignRole($userid, Request $request, UserRepo $userRepo)
    {
        if( $request->roleids === null )
        {
            return \Ajaxalert::error('This staff must have atleast 1 Role assigned')
                ->icon('ban fa-lg')
                ->get();
        }

        $userRepo->syncRoles($userid, $request->roleids);
        return \Ajaxalert::success('Role(s) updated!')
        ->icon('check fa-lg')
        ->get();
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
