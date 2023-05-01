<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @OA\Info(title="My First API", version="0.1")
 */
class TestSwaggerController extends Controller
{
    /**
     * @OA\Get(path="/api/v1/book",
     *   tags={"book"},
     *   security={
     *     {"bearerAuth": {}}
     *   },
     *   summary="Get a list of books",
     *   description="",
     *   operationId="index",
     *   @OA\Response(
     *     response=200,
     *     description="success",
     *     @OA\Schema(type="string"),
     *   ),
     * )
     */
    public function index()
    {
        //
    }

    /**
     * @OA\Get(
     *     path="/api/users",
     *     tags={"Users"},
     *     summary="Get all users",
     *     operationId="getAllUsers",
     *     @OA\Response(
     *         response="200",
     *         description="A list of users",
     *     )
     * )
     */
    public function users() {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
