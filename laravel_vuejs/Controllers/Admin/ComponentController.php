<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ComponentRequest;
use App\Models\Component;
use App\Models\Product;
use Symfony\Component\HttpFoundation\Response;

class ComponentController extends Controller
{
    /**
     * ProductController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:components-read', ['only' => ['index', 'show', 'search', 'jsonIndex']]);
        $this->middleware('permission:components-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:components-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:components-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $components = Component::all();

        return response()->json(['components' => $components], Response::HTTP_OK);
    }

    public function jsonIndex(Product $product)
    {
        return response()->json(['components' => $product->components], Response::HTTP_OK);
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
     * @param ComponentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ComponentRequest $request)
    {
        $validated = $request->validated();

        $component = Component::create([
            'name' => $validated['name'],
            'product_id' => $validated['product_id'],
        ]);

        return response()->json([
            'id' => $component->id
        ]);
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
     * @param ComponentRequest $request
     * @param Component $component
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ComponentRequest $request, Component $component)
    {
        $validated = $request->validated();
        $component->name = $validated['name'];
        $component->save();

        return response()->json([], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Component $component
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Component $component)
    {
        $component->delete();
        return response()->json([], Response::HTTP_OK);
    }
}
