<?php

namespace App\Http\Controllers;

use App\Models\CustomerComplainType;
use Illuminate\Http\Request;

class CustomerComplainTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complainTypes = CustomerComplainType::get();
        return view('complainTypes.index', compact('complainTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('complainTypes.create');
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
        $data = $request->except('_method', '_token');
        $request->validate([
            'name' => 'required|unique:customer_complain_types,name',
            'status' => 'required',
        ]);

        //$data['seqcomplainTypesuence'] = Department::max('sequence') + 1;
        $complainTypes = CustomerComplainType::create($data);
        if ($complainTypes) {
            $message = "You have successfully created";
            return redirect()->route('complainTypes.index', [])
                ->with('flash_success', $message);

        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('complainTypes.index', [])
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
        $complainTypes = CustomerComplainType::findOrFail($id);
        return view('complainTypes.edit', compact('complainTypes'));
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

        $complainTypes = CustomerComplainType::findOrFail($id);
        $complainTypes->update($data);
        if ($complainTypes) {
            $message = "You have successfully updated";
            return redirect()->route('complainTypes.index', [])
                ->with('flash_success', $message);

        } else {
            $message = "Nothing changed!! Please try again";
            return redirect()->route('complainTypes.index', [])
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
        $complainTypes = CustomerComplainType::destroy($id);
        if ($complainTypes) {
            $message = "You have successfully deleted";
            return redirect()->route('complainTypes.index', [])
                ->with('flash_success', $message);
        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('complainTypes.index', [])
                ->with('flash_danger', $message);
        }
    }
}
