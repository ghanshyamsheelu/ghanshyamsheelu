<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('product_access'), 403);
        $products = Product::all();
        //$products = Product::query()
            //->join('category', 'category.id', '=', 'products.categories')->get();
            
        $products->load('category');       
        //echo '<pre>';print_r($products);die; 
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('product_create'), 403);
        $category = Category::pluck('name', 'id');
        return view('admin.products.create', compact('category'));
    }

    public function store(StoreProductRequest $request)
    {
        abort_unless(\Gate::allows('product_create'), 403);
        $postData = $request->all();
        if ($request->hasFile('photo')) {
            $proImage = $request->file('photo');
            $imgName = time().'.'.$proImage->getClientOriginalExtension();
            $destinationPath = public_path('/storage/images');
            $proImage->move($destinationPath, $imgName);
            $postData['photo'] = $imgName;
        } else {
            $postData['photo'] = "";
        }
        $postData['categories'] = $request->categories ? implode(',', $request->categories) : '';
        $product = Product::create($postData);

        return redirect()->route('admin.products.index');
    }

    public function edit(Product $product)
    {
        abort_unless(\Gate::allows('product_edit'), 403);
        $category = Category::pluck('name', 'id');
        return view('admin.products.edit', compact('product', 'category'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        abort_unless(\Gate::allows('product_edit'), 403);
        $postData = $request->all();
        if ($request->hasFile('photo')) {
            
            $proImage = $request->file('photo');
            $imgName = time().'.'.$proImage->getClientOriginalExtension();
            $destinationPath = public_path('/storage/images');
            $proImage->move($destinationPath, $imgName);
            $postData['photo'] = $imgName;
        } else {
            $postData['photo'] = "";
        }
        
        $postData['categories'] = $request->categories ? implode(',', $request->categories) : '';
        //echo '<pre>';print_r($postData['photo']);die;
        $product->update($postData);

        return redirect()->route('admin.products.index');
    }

    public function show(Product $product)
    {
        abort_unless(\Gate::allows('product_show'), 403);
        
        return view('admin.products.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        abort_unless(\Gate::allows('product_delete'), 403);
        $product->delete();
        return back();
    }

    public function massDestroy(MassDestroyProductRequest $request)
    {
        Product::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}