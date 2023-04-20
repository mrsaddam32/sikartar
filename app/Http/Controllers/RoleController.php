<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        if (request()->ajax()) {
            return DataTables::of($roles)
                ->addIndexColumn()
                ->addColumn('created_at', function ($role) {
                    return $role->created_at->format('d F Y');
                })
                ->addColumn('action', function ($role) {
                    return '
                    <a href="#" class="btn btn-sm btn-icon-only text-warning" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                        <i class="fas fa-user-edit"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-icon-only text-danger" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                        <i class="fas fa-trash"></i>
                    </a>
                ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.roles.index', [
            'title' => 'Roles Management',
            'active' => 'admin/roles',
        ], compact('roles'));
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
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
