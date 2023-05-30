<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SebastianBergmann\Diff\Exception;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $request = request();
        $query = Category::query();
        $name = $request->query('name'); /// here use query instead of inut or post to get variable from url
        $status = $request->query('status');
        if($name){
            $query->where('name','LIKE',"%{$name}%");
        }
        if($status){
            $query->where('status','=',$status);
        }
        // use filter scope here
     //   $categories = Category::filter($request->query())->paginate(2);
     $categories = $query->paginate(10);
        // use local scope
      //  $categories = Category::status()->paginate();
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

        $request->validate(Category::rules(),[
            'required'=>'this field (:attribute) is Required',
            'name.unique'=>'the category name is already exists'
        ]);
        $request->merge([
            'slug'=>Str::slug($request->post('name'))
        ]);
        $data = $request->except('image');
        $data['image'] = $this->uploadimage($request);
        $category = Category::create($data);
        // PRG
        return Redirect::route('dashboard.categories.index')->with('success','category created');

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

        try {
            $category = Category::findOrFail($id);
        }catch (Exception $e){
            //abort(404);
            return redirect()->route('dashboard.categories.index')->with('info','this record not found');
        }


        // get all categories expect the category id edited
        $categories = Category::where('id','!=',$id)->get();
        return view('dashboard.categories.edit',compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(Category::rules($id));
        $category = Category::findOrFail($id);
        $data = $request->except('image');
        $old_image = $category->image;
        $new_image = $this->uploadimage($request);
        if($new_image){
            $data['image']=$this->uploadimage($request);
        }
        if($old_image && $new_image){
            Storage::disk('public')->delete($old_image);
        }

        $category->update($data);
      //  $category->fill($request->all())->save();
        return Redirect::route('dashboard.categories.index')->with('success','category Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        if($category->image){
            Storage::disk('public')->delete($category->image);
        }
       // Category::destroy($id);
       // Category::where('id','=',$id)->delete();
        return \redirect()->route('dashboard.categories.index')->with('success','Record Deleted');
    }
    protected function uploadimage(Request $request){
        if(!$request->hasFile('image')){
            return;
        }
            $file = $request->file('image'); // uploaded file object
            //$file->getClientOriginalName();
            //$file->getSize();
            //$file->getClientOriginalExtension();
            //$file->getMimeType();
            $path = $file->store('uploads','public');
            //$data['image']=$path;
        return $path;
        }

    public function trash(){
        $categories = Category::onlyTrashed()->Paginate();
        return view('dashboard.categories.trash',compact("categories"));

    }
    public function restore(Request $request, $id){
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('dashboard.categories.trash')->with('success','category restores success');
    }
    public function force_delete($id){
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        return redirect()->route('dashboard.categories.trash')->with('success','Category deleted Permentaly');

    }


}
