<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    /**
     * Show the user admin page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = \App\Models\User::all();
        return view('user-admin', ['users' => $users]);
    }
}
