<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $users = User::join('roles as r', 'users.role_id', '=', 'r.id')
        ->select(
            'users.id',
            'users.name',
            'users.email',
            'users.role_id',
            'users.address',
            'users.phone',
            'r.name as role'
        )
        ->get();

    return response()->json([
        'message' => 'Users retrieved successfully',
        'users' => $users
    ]);
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);
        return response()->json([
            "message" => "User created successfully",
            "user" => $user
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getTrainers()
    {
        $trainers = User::select('id', 'name', 'email', 'address', 'phone')
            ->where('role_id', 4)
            ->get();
        return response()->json([
            'message' => 'trainers retrieved successfully',
            'trainers' => $trainers
        ]);
    }

}
