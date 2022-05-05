<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Arr;
use App\Http\Traits\ImageUploadTrait;
use App\Http\Interfaces\BasicRepositoryInterface;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
    
class UserController extends Controller
{
    use ImageUploadTrait;
    private BasicRepositoryInterface $basicRepository;
    private $model;
    
    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        // $this->middleware(['auth',"isAdmin"]);
        $this->basicRepository = $basicRepository;
        $this->model = new User;
       
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
   
    public function index(Request $request)
    {
        $users = User::orderBy('id','DESC')->paginate(10);
        return view('user/index',compact('users'));
    }
    

    public function create()
    {
        $roles = Role::get();
        return view('user/create',compact('roles'));
    }
    

    public function store(Request $request)
    {
      
        $validated = $request->validate( [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'phone' => 'required',
        ]);

        $input = $request->all();
        
        $input['password'] = Hash::make($input['password']);
        if ($request->hasFile('image'))
            $input['image'] = $this->imageUpload($request['image'], "user");
        
             
  
        $user = User::create($input);
        $user->assignRole($request->input('role'));
    
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }
    //profile
    public function show($id)
    {
        
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->first();

        return view('user/profile',compact('user','roles','userRole'));
    }
    
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->first();

        return view('user/edit',compact('user','roles','userRole'));
    }

    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required',
        ]);
    
        $input = $request->all();
        
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
        
        if ($request->hasFile('image'))
            $input['image'] = $this->imageUpload($request['image'], "user");
        
        if ($request->hasFile('cv'))
            $input['cv'] = $this->imageUpload($request['cv'], "user");
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('role'));
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }
    
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}