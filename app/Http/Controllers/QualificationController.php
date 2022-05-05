<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Interfaces\BasicRepositoryInterface;
use Illuminate\Support\Facades\DB;

class QualificationController extends Controller
{
    private BasicRepositoryInterface $basicRepository;
    private $model;

    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->basicRepository = $basicRepository;
        $this->model = new Qualification;

        $this->middleware('permission:qualification-list|project-create|project-edit|project-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:qualification-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:project-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:project-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qualifications = $this->basicRepository->getAll($this->model);;
        return view('qualification/index', compact('qualifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
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
            'name' => 'required'
        ]);

        $input = $request->all();

        $qualification = $this->basicRepository->create($this->model, $input);

        return redirect()->route('qualifications.index')
            ->with('success', 'Qualification created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function show($userId)
    {
        
        $user = User::where('id',$userId)->first();
        $qualifications = Qualification::get();

        $userQualifications = DB::table("qualification_user")->where("qualification_user.user_id",$userId)
            ->pluck('qualification_user.qualification_id','qualification_user.qualification_id')
            ->all();
        return view('qualification/myQualifications', compact('user','qualifications','userQualifications'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $qualification = $this->basicRepository->getById($this->model, $id);
        return view('qualification/edit', compact('qualification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $input = $request->only(['name','description']);

        $qualification = $this->basicRepository->update($this->model, $id, $input);

        return redirect()->intended('qualifications')->with('success','Qualification updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->basicRepository->delete($this->model, $id);

        return redirect()->intended('qualifications')->with('success','Qualification deleted successfully');
    }

   
}
