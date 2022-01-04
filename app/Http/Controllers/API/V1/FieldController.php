<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Field\NameStoreRequest;
use App\Models\Field;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $list = Field::where('user_id' , auth()->user()->id)->get();
        return response()->json([
            'success' => true,
            'data' => $list
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(NameStoreRequest $request)
    {
        $field = Field::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Scene "'.$request->name.'" is created successfully',
            'data' => $field
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  Field $field
     * @return \Illuminate\Http\Response
     */
    public function detail(Field $field)
    {
        return response()->json([
            'success' => true,
            'data' => $field
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Field  $field
     * @return \Illuminate\Http\Response
     */
    public function edit(NameStoreRequest $request, Field $field)
    {
        $field->name = $request->name;
        $field->save();

        return response()->json([
            'success' => true,
            'message' => 'Scene "'.$request->name.'" is created successfully',
            'data' => $field
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Field $field
     * @return \Illuminate\Http\Response
     */
    public function delete(Field $field)
    {
        $field->delete();
        return response()->json([
            'success' => true,
            'message' => 'field is deleted successfully!',
        ]);
    }
}
