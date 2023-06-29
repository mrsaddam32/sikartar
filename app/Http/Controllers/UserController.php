<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

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
                    <button type="button" class="mx-1 btn btn-md btn-primary btn-detail" data-bs-toggle="modal" data-bs-target="#userModal"
                    data-id="' . $user->id . '">
                    <i class="fas fa-eye"></i>
                    </button>
                    <form action="' . route('admin.users.destroy', $user->id) . '" method="POST" class="mx-1 d-inline">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <input type="hidden" name="id" value="' . $user->id . '">
                    <button type="submit" name="name" class="btn btn-md btn-danger btn-delete"><i class="fas fa-trash"></i></button>
                    </form>
                    ';
                })
                ->rawColumns(['user', 'role', 'created_at', 'action'])
                ->make(true);
        }

        return view('admin.users.index', [
            'title' => 'Users Management',
            'active' => 'admin/users',
        ], compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create', [
            'title' => 'Create New User',
            'active' => 'admin/users',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email:rfc,dns|unique:users',
            'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()],
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = 2;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'New User created successfully');
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
        $user = User::findOrfail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role;
        $user->save();

        return response()->json(['success' => true, 'message' => 'User updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrfail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
