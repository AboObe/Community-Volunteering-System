<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Traits\ImageUploadTrait;
use App\Http\Interfaces\BasicRepositoryInterface;
use Auth;

class ItemController extends Controller
{
    use ImageUploadTrait;
    private BasicRepositoryInterface $basicRepository;
    private $model;

    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        // $this->middleware(['auth',"isAdmin"]);
        $this->basicRepository = $basicRepository;
        $this->model = new Item;

        $this->middleware('permission:item-list|item-create|item-edit|item-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:item-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:item-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:item-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$products = Product::latest()->paginate(5);
        $items = Item::latest()->paginate(10);
        $categories = Category::get();
        return view('item/index', compact('items','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::get();
        return view('item/create', compact('categories'));
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
            'name' => 'required',
            'category_id' => 'required',
            'type' => 'required',
            'status' => 'required',
            'location' => 'required',
            'date_item' => 'required',
            'type' => 'required',
        ]);

        $input = $request->all();

        $input['user_id'] = Auth::user()->id;
        if ($request->hasFile('image'))
            $input['image'] = $this->imageUpload($request['image'], "item");



        $item = Item::create($input);

        return redirect()->route('items.index')
            ->with('success', 'Item created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->basicRepository->getById($this->model, $id);
        $categories = Category::get();

        return view('item/edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'type' => 'required',
            'status' => 'required',
            'location' => 'required',
            'date_item' => 'required',
            'type' => 'required',
        ]);

        $input = $request->all();

        if ($request->hasFile('image'))
            $input['image'] = $this->imageUpload($request['image'], "item");

        $item = Item::find($id);
        $item->update($input);

        return redirect()->route('items.index')
            ->with('success', 'Item created successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->basicRepository->delete($this->model, $id);

        return redirect()->intended('items')->with('success', 'Item deleted successfully');
    }


    public function search(Request $request)
    {
        $items =Item::filter($request)->paginate(10);

        $categories = Category::get();
        return view('item/index', compact('items','categories'));
    }

    public function myItems(Request $request)
    {
        $items =Item::filter($request)->paginate(10);

        $categories = Category::get();
        return view('item/myItems', compact('items'));
    }
}
