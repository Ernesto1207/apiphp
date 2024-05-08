<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use Illuminate\Http\Request;

class UserDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = auth()->id();

        // Verificar si ya existe un UserDetails para este usuario
        $existingUserDetail = UserDetail::where('user_id', $userId)->first();
        if ($existingUserDetail) {
            return response()->json(['error' => 'User detail already exists'], 409);
        }
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'nullable',
            'district' => 'nullable',
            'province' => 'nullable',
            'department' => 'nullable',
        ]);

        $userDetail = new UserDetail([
            'user_id' => $request->user_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'district' => $request->district,
            'province' => $request->province,
            'department' => $request->department,
        ]);
        $userDetail->save();

        return response()->json(['message' => 'User detail created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(UserDetail $userDetail)
    {
        $user = auth()->user();
        $userDetail = $user->userDetail;

        return response()->json(['user' => $user, 'user_detail' => $userDetail]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserDetail $userDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserDetail $userDetail, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'nullable',
            'district' => 'nullable',
            'province' => 'nullable',
            'department' => 'nullable',
        ]);

        $userDetail = UserDetail::findOrFail($id);
        $userDetail->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'district' => $request->district,
            'province' => $request->province,
            'department' => $request->department,
        ]);

        return response()->json(['message' => 'User detail updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserDetail $userDetail)
    {
        //
    }
}
