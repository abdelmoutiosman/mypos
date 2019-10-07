<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_clients'])->only('index');
        $this->middleware(['permission:create_clients'])->only('create');
        $this->middleware(['permission:update_clients'])->only('edit');
        $this->middleware(['permission:delete_clients'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clients=Client::where(function ($query) use($request){
            return $query->when($request->search, function ($q) use ($request){
                return $q->where('name','like','%'.$request->search.'%')
                    ->orWhere('phone','like','%'.$request->search.'%')
                    ->orWhere('address','like','%'.$request->search.'%');
            });
        })->paginate(3);
        return view('dashboard.clients.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.clients.create');
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
            'name'=>'required|unique:clients,name',
            'phone'=>'required|array|min:1',
            'phone.0'=>'required',
            'address'=>'required',
        ]);
        $client=Client::create($request->all());
        flash()->success(__('messages.Added Successfuly'));
        return redirect(route('dashboard.clients.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record= Client::findOrFail($id);
        return view('dashboard.clients.edit',compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required|unique:clients,name,'.$id,
            'phone'=>'required|array',
            'phone.0'=>'required',
            'address'=>'required',
        ]);
        $client=Client::findOrFail($id);
        $client->update($request->all());
        flash()->success(__('messages.Edited Successfuly'));
        return redirect(route('dashboard.clients.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json([
                'status'  => 0,
                'message' => 'تعذر الحصول على البيانات'
            ]);
        }
        $client->delete();
        return response()->json([
            'status'  => 1,
            'message' => 'تم الحذف بنجاح',
            'id'      => $id
        ]);
    }
}
