<?php

namespace App\Http\Controllers\API\ClientJobs;

use App\Models\ClientJob;
use Illuminate\Http\Request;
use App\Models\ClientJobImage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Clients\Jobs\Images\StoreClientJobImageRequest;

class ClientJobImageController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!$request->route('image')->userCanDelete($request->user())) {
                return response("Not Authorized", 403);
            }

            return $next($request);
        })->only('destroy');
    }

    public function index(Request $request, ClientJob $job)
    {
        return response()->json(['images' => $job->images]);
    }

    public function store(StoreClientJobImageRequest $request, ClientJob $job)
    {
        $path = $request->image->store('public/clients/jobs/images');

        $image = ClientJobImage::create([
            'client_job_id' => $job->id,
            'path' => $path,
            'description' => $request->description
        ]);

        return response()->json(['image' => $image]);
    }

    public function destroy(ClientJob $job, ClientJobImage $image)
    {
        $image->delete();

        return response("Success", 200);
    }
}
