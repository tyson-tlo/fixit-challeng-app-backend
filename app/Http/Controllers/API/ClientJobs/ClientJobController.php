<?php

namespace App\Http\Controllers\API\ClientJobs;

use App\Models\ClientJob;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Clients\Jobs\StoreClientJobRequest;
use App\Http\Requests\Clients\Jobs\UpdateClientJobRequest;

class ClientJobController extends Controller
{
    public function __contruct()
    {
        $this->middleware(function ($request, $next) {
            if (!$request->user()->isAdmin() && $request->user_id !== $request->user()->id) {
                return response("Not Authorized.", 403);
            }

            return $next($request);
        })->only('index');

        // Bleongs to client job
        $this->middleware(function ($request, $next) {

            if ($request->route('job')->user_id != $request->user()->id && !$request->user()->isAdmin()) {
                return response('Not Authorized.', 403);
            }
            return $next($request);
        })->only('show', 'update', 'destroy');
    }

    public function index(Request $request)
    {
        $jobs = ClientJob::where('user_id', $request->user_id)->orderBy('scheduled')->with('address', 'user')->paginate(10);

        return response()->json(['results' => $jobs]);
    }

    public function store(StoreClientJobRequest $request)
    {
        $job = ClientJob::create($request->only('user_id', 'client_address_id', 'details', 'status', 'scheduled', 'service_id'));

        return response()->json(['job' => $job->load('address', 'user', 'service')]);
    }

    public function show(ClientJob $job)
    {
        return response()->json(['job' => $job->load('user', 'address', 'service')]);
    }

    public function update(UpdateClientJobRequest $request, ClientJob $job)
    {
        $job->update($request->validated());

        return response()->json(['job' => $job->load('user', 'address', 'service')]);
    }

    public function destroy(ClientJob $job)
    {
        $job->delete();

        return response("Deleted Resource!", 204);
    }
}
