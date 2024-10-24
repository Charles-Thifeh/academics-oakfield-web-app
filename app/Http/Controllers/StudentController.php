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
            $students = Student::where(['class' => $request->class])->get();
            return view('admin.students.list', ['students' => $students, "status" => $request->status]);
        }

        if($request->status == "Active"){
            $students = Student::where(['status' => 'active', 'class' => $request->class])->get();
            return view('admin.students.list', ['students' => $students, "status" => $request->status]);
        }

        if($request->status == "Inactive"){
            $students = Student::where(['status' => 'active', 'class' => $request->class])->get();
            return view('admin.students.list', ['students' => $students, "status" => $request->status]);
        }
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
