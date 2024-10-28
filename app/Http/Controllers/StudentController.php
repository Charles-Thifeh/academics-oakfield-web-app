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

class StudentController extends Controller
{
    public function index(){
        return view('admin.students.index');
    }

    public function list(Request $request){
        $request->validate([
            'status' => 'required',
            'class' => 'required'
        ]);

        if($request->status == "All"){
            $students = Student::where(['class' => $request->class])->orderBy('surname', 'asc')->get();
            return view('admin.students.list', ['students' => $students, "status" => $request->status]);
        }

        if($request->status == "Active"){
            $students = Student::where(['status' => 'active', 'class' => $request->class])->orderBy('surname', 'asc')->get();
            return view('admin.students.list', ['students' => $students, "status" => $request->status]);
        }

        if($request->status == "Inactive"){
            $students = Student::where(['status' => 'active', 'class' => $request->class])->orderBy('surname', 'asc')->get();
            return view('admin.students.list', ['students' => $students, "status" => $request->status]);
        }
    }

    public function create(){
        return view('admin.students.create');
    }
    public function store(Request $request){
        $request->validate([
            'surname' => 'required',
            'firstname' => 'required',
            'reg_no' => 'required|unique:students,reg_no',
            'class' => 'required',
        ]);

        $password = Hash::make(strtolower($request->surname));

        if(($request->class == 'SSS 1') || ($request->class == 'SSS 2') || ($request->class == 'SSS 3')){
            $level = 'SSS';
        }elseif(($request->class == 'JSS 1') || ($request->class == 'JSS 2') || ($request->class == 'SSS 3')){
            $level = 'JSS';
        }else{
            $level = 'Primary';
        }

        Student::create([
            'surname' => $request->surname,
            'firstname' => $request->firstname,
            'password' => $password,
            'reg_no' => $request->reg_no,
            'class' => $request->class,
            'dept' => $request->department,
            'level' => $level,
        ]);

        Alert::success('Added Successfully', $request->surname." ".$request->firstname." added successfully");
        return redirect()->back();
    }

    public function edit(Request $request){
        $student = Student::where('id', $request->vim)->first();
        return view('admin.students.edit', ['student' => $student]);
    }

    public function update(Request $request){
        $request->validate([
            'id' => 'required',
            'surname' => 'required',
            'firstname' => 'required',
            'reg_no' => 'required',
            'class' => 'required',
        ]);

        $password = Hash::make(strtolower($request->surname));

        Student::where('id', $request->id)
        ->update([
            'surname' => $request->surname,
            'firstname' => $request->firstname,
            'password' => $password,
            'reg_no' => $request->reg_no,
            'class' => $request->class,
            'dept' => $request->department,
        ]);

        Alert::success('Updated Successfully', $request->surname." ".$request->firstname." updated successfully");
        return redirect()->back();
    }

    public function change_status(Request $request){
        $id = $request->vim;
        $status = Student::where('id', $id)->first()->status;
        if($status == 'active'){
            Student::where('id', $id)
            ->update(['status' => 'inactive']);

            return redirect()->back();
        }

        if($status == 'inactive'){
            Student::where('id', $id)
            ->update(['status' => 'active']);

            return redirect()->back();
        }
    }
}
