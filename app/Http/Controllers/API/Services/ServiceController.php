<?php

namespace App\Http\Controllers\API\Services;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('name')->paginate(10);

        return response()->json(['results' => $services]);
    }

    public function search(Request $request)
    {
        $services = Service::where('name', 'like', "%{$request->name}%")->paginate(10);

        return response()->json(['results' => $services]);
    }
}
