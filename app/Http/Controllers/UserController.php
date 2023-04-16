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
        $users = User::where('role_id', '!=', 1)->with('role')->get();

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
                    return '
                    <button type="button" class="btn btn-primary btn-detail" data-bs-toggle="modal" data-bs-target="#userModal"
                    data-id="' . $user->id . '">
                    Detail
                  </button>
                    ';
                })
                ->rawColumns(['user', 'role', 'created_at', 'action'])
                ->make(true);
        }

        return view('dashboard.users.index', [
            'title' => 'Users Management',
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
        $user = User::findOrfail($id);
        return response()->json($user);
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
