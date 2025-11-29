<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        //dd($data);
        $data = $request->except('_method', '_token');
        $request->validate([
            'name' => 'required|unique:products,name',
            'code' => 'required|unique:products,code',
            'status' => 'required',
        ]);

        //$data['seqcomplainTypesuence'] = Department::max('sequence') + 1;
        $products = Product::create($data);
        if ($products) {
            $message = "You have successfully created";
            return redirect()->route('products.index', [])
                ->with('flash_success', $message);

        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('products.index', [])
                ->with('flash_danger', $message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::findOrFail($id);
        return view('products.edit', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_method', '_token');
        $request->validate([
            'status' => 'required',
        ]);

        $products = Product::findOrFail($id);
        $products->update($data);
        if ($products) {
            $message = "You have successfully updated";
            return redirect()->route('products.index', [])
                ->with('flash_success', $message);

        } else {
            $message = "Nothing changed!! Please try again";
            return redirect()->route('products.index', [])
                ->with('flash_warning', $message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Product::destroy($id);
        if ($products) {
            $message = "You have successfully deleted";
            return redirect()->route('products.index', [])
                ->with('flash_success', $message);
        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('products.index', [])
                ->with('flash_danger', $message);
        }
    }
}
