<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Midterm;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use Alert;
use Hash;


class TeacherController extends Controller
{
    public function index(){
        $teachers = DB::table('subjects')->where('teacher_id', 'LIKE', '%TEA%')->orderBy('surname', 'asc')->paginate(10);

        return view('admin.teacher.index', ['teachers' => $teachers]);
    }
    public function create(){
        return view('admin.teacher.create');
    }
    public function store(Request $request){
        $request->validate([
            'surname' => 'required',
            'firstname' => 'required',
            'teacherid' => 'required|unique:subjects,teacher_id'
        ]);

        $password = Hash::make(strtolower($request->surname));

        Subject::create([
            'surname' => $request->surname,
            'firstname' => $request->firstname,
            'password' => $password,
            'teacher_id' => $request->teacherid,
            'class' => $request->class
        ]);

        Alert::success('Added Successfully', $request->surname." ".$request->firstname." added successfully");
        return redirect()->route('admin-teacher');
    }

    public function edit(Request $request){
        $teacher = Subject::where('id', $request->vim)->first();
        return view('admin.teacher.edit', ['teacher' => $teacher]);
    }

    public function update(Request $request){
        $request->validate([
            'id' => 'required',
            'surname' => 'required',
            'firstname' => 'required',
            'teacherid' => 'required'
        ]);

        $password = Hash::make(strtolower($request->surname));

        Subject::where('id', $request->id)
        ->update([
            'surname' => $request->surname,
            'firstname' => $request->firstname,
            'password' => $password,
            'teacher_id' => $request->teacherid,
            'class' => $request->class
        ]);

        Alert::success('Updated Successfully', $request->surname." ".$request->firstname." updated successfully");
        return redirect()->route('admin-teacher');
    }
}
