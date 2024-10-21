<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class SubjectRegistrationController extends Controller
{
    public function index(){
        $dept = Student::where("id", Auth::id())->first();
        if (strtoupper($dept->level) == "SSS"){
            return view("subject-registration.confirm-dept", compact('dept'));
        }
        if(strtoupper($dept->level) == "JSS"){
            return view("subject-registration.jss_index", compact('dept'));
        }
        if (strtoupper($dept->level) == "PRIMARY"){
            return view("subject-registration.primary_index", compact('dept'));
        }
    }

    public function confirm(Request $request){
        $dept = Student::where("id", Auth::id())->first()->dept;
        return view("subject-registration.ss_index", compact('dept'));
    }
}
