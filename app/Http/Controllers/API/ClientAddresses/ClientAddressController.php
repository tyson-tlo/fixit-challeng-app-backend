<?php

namespace App\Http\Controllers\API\ClientAddresses;

use Illuminate\Http\Request;
use App\Models\ClientAddress;
use App\Http\Controllers\Controller;
use App\Http\Requests\Clients\Addresses\StoreClientAddressRequest;
use App\Http\Requests\Clients\Addresses\UpdateClientAddressRequest;

class ClientAddressController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!$request->route('address')->userCanView($request->user())) {
                return response("Unauthorized", 403);
            }

            return $next($request);
        })->only('show');
    }

    public function index(Request $request)
    {
        $addresses = ClientAddress::where('user_id', $request->user_id)->get();

        return response()->json(['addresses' => $addresses]);
    }

    public function store(StoreClientAddressRequest $request)
    {
        $address = ClientAddress::create($request->validated());

        return response()->json(['address' => $address], 201);
    }

    public function show(ClientAddress $address)
    {
        return response()->json(['address' => $address]);
    }

    public function update(UpdateClientAddressRequest $request, ClientAddress $address)
    {
        $address->update($request->validated());

        return response()->json(['address' => $address]);
    }

    public function destroy(ClientAddress $address)
    {
        $address->delete();

        return response("Deleted!", 204);
    }
}
