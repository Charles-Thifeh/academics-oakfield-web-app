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

class UploadResultController extends Controller
{
    public function index(){
        $id = Subject::find(Auth::id())->teacher_id;
        $subjects = DB::table('subtables')->where("teacher_id", $id)->get();
        $level = DB::table('subtables')->select('level')->distinct()->where("teacher_id", $id)->get();
        $session = DB::table('calenders')->select('session')->distinct()->get();
        $class = [];
        foreach($level as $item){
            if($item->level == "Primary"){
                $class[] = "Primary 1";
                $class[] = "Primary 2";
                $class[] = "Primary 3";
                $class[] = "Primary 4";
                $class[] = "Primary 5";
                $class[] = "Primary 6";
            }
            if($item->level == "JSS"){
                $class[] = "JSS 1";
                $class[] = "JSS 2";
                $class[] = "JSS 3";
            }
            if($item->level == "SSS"){
                $class[] = "SSS 1";
                $class[] = "SSS 2";
                $class[] = "SSS 3";
            }
        }

        return view('result.index', ['subjects' => $subjects, 'session' => $session, 'class' => $class]);
    }

    public function class_index(){
        $class = Subject::find(Auth::id())->class;
        $session = DB::table('calenders')->select('session')->distinct()->get();
        return view('result.index', ['session' => $session, "class" => $class]);
    }

    public function query(Request $request){
        $request->validate([
            'session' => 'required',
            'term' => 'required',
            'type' => 'required',
            'subject' => 'required',
            'class' => 'required',
        ]);

        $type = $request->type;
        $term = $request->term;
        $session = $request->session;
        $subject = DB::table("subtables")->where("id", $request->subject)->first()->subject;
        $class = $request->class;

        $time = Carbon::now();
        if($type == "midterm"){
            $students = DB::table('students')->where([
                'class' => $class,
                'status' => "active"
            ])->get();
            // var_dump($students);
            $i = 0;

            foreach($students as $item){
                $check = DB::table('midterms')->where([
                    'term' => $term,
                    'session' => $session,
                    'subject' => $subject,
                    'reg_no' => $item->reg_no,
                ])->first();




                if($check == null){
                    Midterm::create([
                        'reg_no' => $item->reg_no,
                        'class' => $item->class,
                        'subject' => $subject,
                        'session' => $session,
                        'term' => $term
                    ]);
                }
                $results = DB::table('midterms')
                                ->where([
                                    'class' => $class,
                                    'subject' => $subject,
                                    'session' => $session,
                                    'term' => $term
                                ])->get();
                return view('result.upload', ['results' => $results]);
            }
        }
    }

    public function class_query(Request $request){
        $request->validate([
            'session' => 'required',
            'term' => 'required',
            'type' => 'required',
            'subject' => 'required',
            'class' => 'required',
        ]);

        $type = $request->type;
        $term = $request->term;
        $session = $request->session;
        $subject = $request->subject;
        $class = $request->class;

        $time = Carbon::now();
        if($type == "midterm"){
            $students = DB::table('students')->where([
                'class' => $class,
                'status' => "active"
            ])->get();
            // var_dump($students);
            $i = 0;

            foreach($students as $item){
                $check = DB::table('midterms')->where([
                    'term' => $term,
                    'session' => $session,
                    'subject' => $subject,
                    'reg_no' => $item->reg_no,
                ])->first();




                if($check == null){
                    Midterm::create([
                        'reg_no' => $item->reg_no,
                        'class' => $item->class,
                        'subject' => $subject,
                        'session' => $session,
                        'term' => $term
                    ]);
                }
                $results = DB::table('midterms')
                                ->where([
                                    'class' => $class,
                                    'subject' => $subject,
                                    'session' => $session,
                                    'term' => $term
                                ])->get();
                return view('result.upload', ['results' => $results]);
            }
        }
    }

    public function queryUpload(Request $request){
        $records = array_chunk($request->records,3);
        $id = Subject::find(Auth::id())->teacher_id;
        foreach($records as $item){
            // echo $item[0]." ";
            // echo $item[1]." ";
            // echo $item[2]." ";
            // echo " ------ ";
            $ts = $item[1] + $item[2];
            Midterm::where("id", $item[0])
                ->update([
                    "at" => $item[1],
                    "ex" => $item[2],
                    "ts" => $ts,
                    "uploaded_by" => $id,
                ]);
        }
        Alert::success("Successful", "Uploading Successful");
        return redirect()->back();
    }
}
