<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Traits\ImageUploadTrait;
use App\Http\Interfaces\BasicRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    use ImageUploadTrait;
    private BasicRepositoryInterface $basicRepository;
    private $model;

    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        // $this->middleware(['auth',"isAdmin"]);
        $this->basicRepository = $basicRepository;
        $this->model = new Category;
       
        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->basicRepository->getAll($this->model);
        return view('category/index', compact('categories'));
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
    
        $validated = $request->validate([
            'name'   => 'required|max:250|unique:categories',
            'description'   => 'required',
            'image'   => 'mimes:jpeg,png,jpg,gif|max:2048'
        ]);
       
        $category_ = $request->only([
            'name',
            'description',
        ]);
        if ($request->hasFile('image'))
            $category_['image'] = $this->imageUpload($request['image'], "category");

        $category = $this->basicRepository->create($this->model, $category_);

        return redirect()->intended('categories')->with('success','Category created successfully.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->basicRepository->getById($this->model, $id);
        return view('category/edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {

        $validated = $request->validate([
            'name'   => 'required|max:250|unique:categories,name,' . $id,
            'description'   => 'required',
            'image'   => 'mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $category_ = $request->only([
            'name',
            'description',
        ]);

        if ($request->hasFile('image'))
            $category_['image'] = $this->imageUpload($request['image'], "category");

        $category = $this->basicRepository->update($this->model, $id, $category_);

        return redirect()->intended('categories')->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->basicRepository->delete($this->model, $id);

        return redirect()->intended('categories')->with('success','Category deleted successfully');
    }
}
