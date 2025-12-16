<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return response()->json([
            "message" => "ok",
            "roles" => $roles
        ], 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = Role::create([
            'name' => $request->name
        ]);

        return response()->json([
            "message" => "Role created successfully",
            "data" => $role
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
        $role = Role::find($id);
        if (!$role) {
            return response()->json([
                "error" => true,
                "message" => "Could not find that role!"]);
        } else {
            $role->delete();
            return response()->json([
                "error" => false,
                "message" => "Role deleted successfully"]);
    }
}
}