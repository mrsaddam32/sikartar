<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        if (request()->ajax()) {
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('photo_path', function ($user) {
                    if ($user->photo_path) {
                        return '<img src="' . asset('storage/' . $user->photo_path) . '" alt="photo" width="50" height="50">';
                    } else {
                        return '<img src="' . asset('storage/users/default.png') . '" alt="photo" width="50" height="50">';
                    }
                })
                ->addColumn('role', function ($user) {
                    if ($user->role_id == 1) {
                        return '<span class="badge badge-sm bg-gradient-danger">
                                    ' . $user->role->role_name . '
                                </span>';
                    } else {
                        return '<span class="badge badge-sm bg-gradient-info">
                                    ' . $user->role->role_name . '
                                </span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn = $btn . ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['role', 'action'])
                ->toJson();
        }

        return view('dashboard.users.index', [
            'title' => 'Users',
            'active' => 'users',
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
