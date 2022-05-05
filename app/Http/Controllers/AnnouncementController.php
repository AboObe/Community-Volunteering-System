<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Interfaces\BasicRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AnnouncementController extends Controller
{
    private BasicRepositoryInterface $basicRepository;
    private $model;

    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        //$this->middleware('auth');
        $this->basicRepository = $basicRepository;
        $this->model = new Announcement;
        $this->project_model = new Project;

        $this->middleware('permission:announcement-list|announcement-create|announcement-edit|announcement-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:announcement-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:announcement-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:announcement-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = $this->basicRepository->getAll($this->model);
        $projects = $this->basicRepository->getAll($this->project_model);
        $userAnnouncements = DB::table("announcement_user")->where("announcement_user.user_id",Auth()->user()->id)
            ->pluck('announcement_user.announcement_id','announcement_user.announcement_id')
            ->all();

       return view('announcement/index', compact('announcements','projects','userAnnouncements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = $this->basicRepository->getAll($this->project_model);
        return view('announcement/create', compact('projects'));
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
            'address' => 'required',
            'description' => 'required',
            'project_id' => 'required',
        ]);

        $input = $request->all();

        $announcement = $this->basicRepository->create($this->model, $input);

        return redirect()->route('announcements.index')
            ->with('success', 'Announcement created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show($userId)
    {
        $user = User::where('id',$userId)->first();
        $announcements = Announcement::get();

        $userAnnouncements = DB::table("announcement_user")->where("announcement_user.user_id",$userId)
            ->pluck('announcement_user.announcement_id','announcement_user.announcement_id')
            ->all();
    
        return view('announcement/myAnnouncements', compact('user','announcements','userAnnouncements'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $announcement = $this->basicRepository->getById($this->model, $id);
        $projects = $this->basicRepository->getAll($this->project_model);
        return view('announcement/edit', compact('announcement','projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'description' => 'required',
            'project_id' => 'required',
        ]);

        $input = $request->only(["name",
        'address', 'description', 'project_id','status','hours']);

        $announcement = $this->basicRepository->update($this->model, $id, $input);

        return redirect()->intended('announcements')->with('success','Announcement updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->basicRepository->delete($this->model, $id);

        return redirect()->intended('announcements')->with('success','Announcement deleted successfully');
    }

    public function search(Request $request)
    {
        $announcements =$this->model::filter($request)->paginate(10);

        $projects = Project::get();
        return view('announcement/index', compact('announcements','projects'));
    }
}
