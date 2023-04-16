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
        $users = User::with('role')->get();

        if (request()->ajax()) {
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('role', function ($user) {
                    if ($user->role_id == 1) {
                        return '<span class="w-100 text-uppercase badge bg-gradient-danger">' . $user->role->role_name . '</span>';
                    } else {
                        return '<span class="w-100 text-uppercase badge bg-gradient-info">' . $user->role->role_name . '</span>';
                    }
                })
                ->addColumn('created_at', function ($user) {
                    return $user->created_at->format('d F Y');
                })
                ->addColumn('action', function ($user) {
                    if (Auth::user()->role_id == 1) {
                        return '
                        <a href="#" class="btn btn-sm btn-icon-only text-warning" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                            <i class="fas fa-user-edit"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-icon-only text-danger" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                            <i class="fas fa-trash"></i>
                        </a>
                    ';
                    } else {
                        return '
                        <a href="#" class="btn btn-sm btn-icon-only text-light" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                            <i class="fas fa-user-edit"></i>
                        </a>
                    ';
                    }
                })
                ->rawColumns(['user', 'role', 'action'])
                ->make(true);
        }

        return view('dashboard.users.index', [
            'title' => 'Users',
            'active' => 'users',
        ], compact('users'));
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
