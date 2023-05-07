<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //use request merge to add slug value from here not form
        $request->merge([
            'slug'=>Str::slug($request->post('name'))
        ]);
       /* $request->input('name');
        $request->post('name');
        $request->get('name');
        $request->name;
        $request['name'];
       $request->all()  return all values as array
       */
/* first one way
        $category = new Category([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
        ]);
*/
        /* second way
        $category = new Category($request->all());
        $category->save();
*/
        /* third way

        $category = new Category();
        $category->name = $request->input('name');
        $category->parent_id = $request->input('parent_id');
        $category->save();
        */

        $category = Category::create($request->all());
        // PRG
        return Redirect::route('categories.index')->with('success','category created');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
