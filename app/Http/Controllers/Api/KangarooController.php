<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\KangarooRequest;
use App\Http\Resources\KangarooResource;
use App\Kangaroo;
use Exception;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class KangarooController extends Controller
{
    public function index()
    {
        return KangarooResource::collection(Kangaroo::all()->sortByDesc('id')); 
    }

    public function store(KangarooRequest $request)
    {
        try {
            Kangaroo::create($request->validated());
            $content = ['message' => 'Successfully added a kangaroo!', 'class' => 'alert-success'];
            $status = Response::HTTP_OK;
        } catch (Exception $e) {
            $content = ['message' => 'An unknown error was encountered', 'class' => 'alert-danger'];
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            Log::error($e->getMessage());
        } 
        return response($content, $status);
    }

    public function show(Kangaroo $kangaroo)
    {
        return new KangarooResource($kangaroo);
    }

    public function update(Kangaroo $kangaroo, KangarooRequest $request)
    {
        try {
            $kangaroo->update($request->validated());
            $content = ['message' => 'Successfully updated the data!', 'class' => 'alert-success'];
            $status = Response::HTTP_OK;
        } catch (Exception $e) {
            $content = ['message' => 'An unknown error was encountered', 'class' => 'alert-danger'];
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            Log::error($e->getMessage());
        }
        
        return response($content, $status);
    }

    public function destroy(Kangaroo $kangaroo)
    {
        try {
            $kangaroo->delete();
            $content = ['message' => 'Successfully deleted the data!', 'class' => 'alert-success'];
            $status = Response::HTTP_OK;;
        } catch (Exception $e) {
            $content = ['message' => 'An unknown error was encountered', 'class' => 'alert-danger'];
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            Log::error($e->getMessage());
        }

        return response($content, $status);
    }
}
