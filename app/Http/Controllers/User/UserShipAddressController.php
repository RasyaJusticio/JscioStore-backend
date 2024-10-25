<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ShipAddress\UserAddressStoreRequest;
use App\Http\Requests\User\ShipAddress\UserAddressUpdateRequest;
use App\Models\ShipAddress;
use Illuminate\Http\Request;

class UserShipAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        return $this->success($user->shipAddresses->map(function ($address) {
            return $address->only([
                'id',
                'address',
                'default',
                'created_at',
                'updated_at',
            ]);
        }));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserAddressStoreRequest $request)
    {
        $user = $request->user();
        $fields = $request->validated();

        $attr = collect($fields);
        if ($user->shipAddresses()->count() === 0) {
            $attr->put('default', true);
        }

        $user->shipAddresses()->create($attr->toArray());

        return $this->success('Address added successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShipAddress $shipAddress)
    {
        return $this->success($shipAddress);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserAddressUpdateRequest $request, ShipAddress $shipAddress)
    {
        $user = $request->user();
        $fields = $request->validated();

        $attr = collect($fields);
        if ($user->shipAddresses()->count() === 1) {
            $attr->put('default', true);
        }

        $shipAddress->update($attr->toArray());

        return $this->success('Address updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, ShipAddress $shipAddress)
    {
        $user = $request->user();

        if ($user->shipAddresses()->count() === 1) {
            return $this->fail('You need at least one shipping address.');
        }

        $shipAddress->delete();

        return $this->success('Address deleted successfully');
    }
}
