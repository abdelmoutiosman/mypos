<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Storage;
use Image;
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_products'])->only('index');
        $this->middleware(['permission:create_products'])->only('create');
        $this->middleware(['permission:update_products'])->only('edit');
        $this->middleware(['permission:delete_products'])->only('destroy');
    }
    public function index(Request $request)
    {
        $products=Product::when($request->search, function ($q) use ($request){
                return $q->where('name','like','%'.$request->search.'%');
            })->when($request->category_id, function ($q) use ($request){
                    return $q->where('category_id','like','%'.$request->category_id.'%');
        })->latest()->paginate(3);
        return view('dashboard.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::pluck('name','id')->toArray();
        return view('dashboard.products.create',compact('categories'));
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
            'name'=>'required|unique:products,name',
            'description'=>'required',
            'image'=>'image',
            'purchase_price'=>'required',
            'sale_price'=>'required',
            'stock'=>'required'
        ]);
        $product=Product::create($request->except('image'));
        if($request->image){
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/product_images/' . $request->image->hashName()),60);
            $product->update(['image' => $request->image->hashName()]);
        }
        flash()->success(__('messages.Added Successfuly'));
        return redirect(route('dashboard.products.index'));
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
        $record= Product::findOrFail($id);
        return view('dashboard.products.edit',compact('record'));
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
            'name'=>'required|unique:products,name,'.$id,
            'description'=>'required',
            'image'=>'image',
            'purchase_price'=>'required',
            'sale_price'=>'required',
            'stock'=>'required'
        ]);
        $product=Product::findOrFail($id);
        $product->update($request->except('image'));
        if($request->image){
            if ($product->image != 'default.png'){
                Storage::disk('public_uploads')->delete('/product_images/' . $product->image);
            }
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/product_images/' . $request->image->hashName()),60);
            $product->image = $request->image->hashName();
        }
        $product->save();
        flash()->success(__('messages.Edited Successfuly'));
        return redirect(route('dashboard.products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'status'  => 0,
                'message' => 'تعذر الحصول على البيانات'
            ]);
        }
        if ($product->image != 'default.png'){
            Storage::disk('public_uploads')->delete('/product_images/' . $product->image);
        }
        $product->delete();
        return response()->json([
            'status'  => 1,
            'message' => 'تم الحذف بنجاح',
            'id'      => $id
        ]);
    }
}
