<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use DataTables;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:city-list', ['only' => ['index']]);
        $this->middleware('permission:city-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:city-edit', ['only' => ['edit','update']]);
    }
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = City::with(['state','state.country:id,name']);

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        return view('cities.components.action',compact('row'));
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('cities.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) 
    {
        try {
            $validated = $request->validate([
                'country_id' => 'required|integer|exists:countries,id',
                'state_id'   => 'required|integer|exists:states,id',
                'name'       => 'required|string|max:100|unique:cities,name',
            ], [
                'country_id.required' => 'Please select a country.',
                'state_id.required'   => 'Please select a state.',
                'name.required'       => 'Please enter the city name.',
            ]);

            $city = new City();
            $city->name = $validated['name'];
            $city->state_id = $validated['state_id'];
            $city->country_id = $validated['country_id'];
            $city->save();
            Toastr::success("Added Successfully");
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['city'] = City::find($id);
        return view('cities.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) 
    {
        try {
            $validated = $request->validate([
                'country_id' => 'required|integer|exists:countries,id',
                'state_id'   => 'required|integer|exists:states,id',
                'name'       => 'required|string|max:100|unique:cities,name,' . $id,
            ], [
                'country_id.required' => 'Please select a country.',
                'state_id.required'   => 'Please select a state.',
                'name.required'       => 'Please enter the city name.',
            ]);

            $city = City::findOrFail($id);
            $city->name = $validated['name'];
            $city->state_id = $validated['state_id'];
            $city->country_id = $validated['country_id'];
            $city->save();
            Toastr::success("Updated Successfully");
            return redirect()->route('cities.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function list_for_select_ajax(Request $request)
    {
        $items = City::query();
        if ($request->search != '') {
            $items = $items->whereLike(['name'], $request->search);
        }
        if ($request->country_id > 0) {
            $items = $items->whereHas('state', function ($query) use ($request) {
                                $query->where('country_id', $request->country_id);
                            });
        }
        $items = $items->with(['country:id,name'])->paginate(10,['id','name','country_id']);
        $response = [];
        foreach($items as $item){
            $response[]  =[
                'id'    => $item->id,
                'text'  => $item->country->name.' : '.$item->name
            ];
        }
        $data['results'] =  $response;
        if ($items->count() > 0)
        {
            $data['pagination'] =  ["more" => true];
        }
        return response()->json($data);
    }

    public function list_for_select_ajax_state(Request $request)
    {
        $items = State::query();
        if ($request->search != '') {
            $items = $items->whereLike(['name'], $request->search);
        }
        if ($request->country_id > 0) {
            $items = $items->where('country_id', $request->country_id);
        }
        $items = $items->paginate(10,['id','name']);
        $response = [];
        foreach($items as $item){
            $response[]  =[
                'id'    => $item->id,
                'text'  => $item->name
            ];
        }
        $data['results'] =  $response;
        if ($items->count() > 0)
        {
            $data['pagination'] =  ["more" => true];
        }
        return response()->json($data);
    }

    public function list_for_select_ajax_country(Request $request)
    {
        $items = Country::query();
        if ($request->search != '') {
            $items = $items->whereLike(['name'], $request->search);
        }
        $items = $items->paginate(10,['id','name']);
        $response = [];
        foreach($items as $item){
            $response[]  =[
                'id'    => $item->id,
                'text'  => $item->name
            ];
        }
        $data['results'] =  $response;
        if ($items->count() > 0)
        {
            $data['pagination'] =  ["more" => true];
        }
        return response()->json($data);
    }
}
