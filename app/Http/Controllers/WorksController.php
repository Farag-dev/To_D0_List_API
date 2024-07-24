<?php

namespace App\Http\Controllers;

use App\Models\works;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;

class WorksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $works=Works::orderBy('id','asc')->where('user_id',auth()->user()->id)->paginate(10);
        // return view('FrontEnd.allworks',compact('works'));
        $works=Works::all();
        return response()->json(['message'=>'success','data'=>$works]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('FrontEnd.addwork');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
       $work= Works::create($request->all());

        // return redirect()->route('work.index')->with('status','Task added successfully!');
        return response()->json(['message'=>'success','data'=>$work]);
    }
    public function ChangeStatus($id , Request $request)
    {
        $work=Works::find($id);
        Works::where('id',$id)->update(['status'=> $request->status]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        if (!$request->status){
             $works=Works::latest()->paginate(10);
             return view('FrontEnd.allworks', compact('works'));
        }
        $works=Works::where('status',$request->status)->paginate(10);
        return view('FrontEnd.allworks', compact('works'));


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $work=Works::find($id);
        return view('FrontEnd.editwork',compact('work'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $work=Works::find($id);
        $work->update($request->all());
        return response()->json(['message'=>'task updated successfully','data'=>$work]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $work=Works::find($id);
        $work->delete();
        return response()->json(['message'=>'task deleted successfully','data'=>$work]);
    }
}
