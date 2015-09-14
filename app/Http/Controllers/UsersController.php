<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;
use App\Http\Controllers\BaseController;
use App\Libs\Repos\UserRepo as UserRepo;
use App\Libs\Repos\ActivityRepo as ActivityRepo;
use Makehash;
use Auth, Ajaxalert, Event, App\Events\UserLoggedIn;

class UsersController extends BaseController
{
    public function processLogout()
    {
        $this->logout();
        return \Redirect::route('home');
    }

    public function showLogin()
    {
        $data['pagetitle'] = 'Login place';
        return view('home.login', $data);
    }

    /**
     * Authenticate the user.
     *
     * @return Response
     */
    public function processLogin( UserRequest $userRequest, UserRepo $userModel, ActivityRepo $activity )
    {
		$fields = $userRequest->only('username', 'password');

        if( $this->_userAuth($fields) === false )
        {
            return Ajaxalert::error('User does not exist')
                    ->icon('user fa-lg')
                    ->get();
        }

        if( $this->_isEnabled() === false)
        {
            $this->logout();
            return Ajaxalert::error('Account is disabled. Contact administrator')
                    ->icon('ban fa-lg')
                    ->get();
        }

       // $fired = Event::fire( new UserLoggedIn(Auth::user()) );

        return Ajaxalert::success('Access granted. Redirecting...')
                ->icon('fa-paper-plan')
                ->url( \Redirect::intended( route($this->_roleLandingPage( Auth::user() )) )->getTargetUrl() )
                ->get();

       // tt(Auth::user()->is('sales'));

    }

    private function _userAuth(Array $user)
    {
        return Auth::attempt($user);
    }

    private function _isEnabled()
    {
        return (Auth::user()->isenabled === 1) ? true : false;
    }

    private function _roleLandingPage($user)
    {
        if( $user->is('admin') ) { return 'admin.dashboard'; }

        //tt($user->is('sales'));

        if( $user->is('sales') ) { return 'home'; }
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
     * @return Response
     */
    public function store()
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
     * @param  int  $id
     * @return Response
     */
    public function update($id)
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
