<?php

namespace App\Http\Controllers;

use App\Models\RestaurantsDetails;
use App\Http\Requests\UpdateRestaurantsDetailsRequest;
use Illuminate\Http\Request;

class RestaurantsDetailsController extends Controller
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
        $restaurantId = auth()->user()->id;


        $existingUserDetail = RestaurantsDetails::where('restaurants_id', $restaurantId)->first();
        if ($existingUserDetail) {
            return response()->json(['error' => 'Restaurant detail already exists'], 409);
        }

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'nullable',
            'district' => 'nullable',
            'province' => 'nullable',
            'department' => 'nullable',
        ]);

        $restaurantsDetails = new RestaurantsDetails([
            'restaurants_id' => $restaurantId,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'district' => $request->district,
            'province' => $request->province,
            'department' => $request->department,
        ]);

        $restaurantsDetails->save();

        return response()->json(['message' => 'Restaurant detail created successfully'], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(RestaurantsDetails $restaurantsDetails)
    {

        $restaurant = $restaurantsDetails->restaurant;

        return response()->json(['restaurant_details' => $restaurantsDetails, 'restaurant' => $restaurant]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RestaurantsDetails $restaurantsDetails)
    {
        return response()->json(['restaurant_details' => $restaurantsDetails]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantsDetailsRequest $request, RestaurantsDetails $restaurantsDetails)
    {
        $restaurantsDetails->update($request->validated());

        return response()->json(['message' => 'Restaurant details updated successfully', 'restaurant_details' => $restaurantsDetails]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RestaurantsDetails $restaurantsDetails)
    {
        //
    }
}
