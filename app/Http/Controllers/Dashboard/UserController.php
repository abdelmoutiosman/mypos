<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Image;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users=User::whereRoleIs('admin')->where(function ($query) use($request){
            return $query->when($request->search, function ($q) use ($request){
                return $q->where('first_name','like','%'.$request->search.'%')
                    ->orWhere('last_name','like','%'.$request->search.'%');
            });
        })->paginate(3);
        return view('dashboard.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name'=>'required|unique:users,first_name',
            'last_name'=>'required',
            'email'=>'required',
            'image'=>'image',
            'password'=>'required|confirmed',
            'permissions'=>'required|array'
        ]);
        $request->merge(['password' => bcrypt($request->password)]);
        $user=User::create($request->except(['permissions','image']));
        if($request->image){
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_images/' . $request->image->hashName()),60);
           $user->update(['image' => $request->image->hashName()]);
        }
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);
        flash()->success(__('messages.Added Successfuly'));
        return redirect(route('dashboard.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record= User::findOrFail($id);
        return view('dashboard.users.edit',compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'first_name'=>'required|unique:users,first_name,'.$id,
            'last_name'=>'required',
            'email'=>'required',
            'image'=>'image',
            'password'=>'required|confirmed',
            'permissions'=>'required|array'
        ]);
        $user=User::findOrFail($id);
        $user->syncPermissions($request->permissions);
        $request->merge(['password' => bcrypt($request->password)]);
        $user->update($request->except('image'));
        if($request->image){
            if ($user->image != 'default.png'){
                Storage::disk('public_uploads')->delete('/user_images/' . $user->image);
            }
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_images/' . $request->image->hashName()),60);
            $user->image = $request->image->hashName();
        }
        $user->save();
        flash()->success(__('messages.Edited Successfuly'));
        return redirect(route('dashboard.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status'  => 0,
                'message' => 'تعذر الحصول على البيانات'
            ]);
        }
        if ($user->image != 'default.png'){
         Storage::disk('public_uploads')->delete('/user_images/' . $user->image);
        }
        $user->delete();
        return response()->json([
            'status'  => 1,
            'message' => 'تم الحذف بنجاح',
            'id'      => $id
        ]);
    }
}
