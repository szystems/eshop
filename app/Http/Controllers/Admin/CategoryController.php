<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\CategoriaFormRequest;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if($request)
        {
            $queryCategory=$request->input('fcategory');
            $categories=DB::table('categories')
            ->where('name','LIKE','%'.$queryCategory.'%')
            ->orderBy('name','asc')
            ->paginate(25);
            $filterCategories = Category::all();
            return view('admin.category.index', compact('categories','queryCategory','filterCategories'));
        }

    }

    public function show($id)
    {
        $category = Category::find($id);
        return view('admin.category.show', compact('category'));
    }

    public function add()
    {
        return view('admin.category.add');
    }

    public function insert(CategoriaFormRequest $request)
    {
        $category = new Category();
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/category',$filename);
            $category->image = $filename;
        }

        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        $category->status = $request->input('status') == TRUE ? '1':'0';
        $category->popular = $request->input('popular') == TRUE ? '1':'0';
        $category->meta_title = $request->input('meta_title');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->meta_descrip = $request->input('meta_descrip');
        $category->save();

        return redirect('/categories')->with('status', "Category Added Successfully");
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', \compact('category'));
    }

    public function update(CategoriaFormRequest $request, $id)
    {
        $category = Category::find($id);
        if($request->hasFile('image'))
        {
            $path = 'assets/uploads/category/'.$category->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/category',$filename);
            $category->image = $filename;
        }
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        $category->status = $request->input('status') == TRUE ? '1':'0';
        $category->popular = $request->input('popular') == TRUE ? '1':'0';
        $category->meta_title = $request->input('meta_title');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->meta_descrip = $request->input('meta_descrip');
        $category->update();

        return redirect('/categories')->with('status',"Category Updated Successfully");
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category->image)
        {
            $path = 'assets/uploads/category/'.$category->image;
            if (File::exists($path))
            {
                File::delete($path);

            }
        }
        $category->delete();
        return redirect('/categories')->with('status',"Category Deleted Successfully");
    }
}
