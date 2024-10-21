<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Alert;
use DB;

class TeacherController extends Controller
{
    public function index(){
        $teachers = DB::table('subjects')->where('teacher_id', 'LIKE', '%TEA%')->orderBy('created_at', 'asc')->get();

        return view('admin.teacher.index', ['teachers' => $teachers]);
    }
}
