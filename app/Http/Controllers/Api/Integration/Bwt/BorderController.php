<?php

namespace App\Http\Controllers\Api\Integration\Bwt;

use App\Helpers\BwtHelper\Border as BwtHelperBorder;
use App\Models\Border;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Border as BorderRequest;
use Illuminate\Support\Facades\Request;

class BorderController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $response = BwtHelperBorder::getBorderWidthCords(request()->coordinate_one, request()->coordinate_two, request()->coordinate_tree, request()->line);
        } catch (\Exception $err) {
            return response()->json([
                'success' => false,
                'message' =>  $err->getMessage(),
                'data' => null,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Listo',
            'data' => $response
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Border $border)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Border $border)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Border $border)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Border $border)
    {
        //
    }
}
