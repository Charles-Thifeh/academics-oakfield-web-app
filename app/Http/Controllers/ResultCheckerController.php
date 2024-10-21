<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Alert;
use DB;

class ResultCheckerController extends Controller
{
    public function index(){
        $session = DB::table('calenders')->select('session')->distinct()->get();
        return view("result-checker.index", ['session' => $session]);
    }

    public function check_result(Request $request){
        $type = $request->type;
        $term = $request->term;
        $session = $request->session;
        $reg_no = DB::table("students")->where("id", Auth::id())->first()->reg_no;

        $jss = array('JSS 1', 'JSS 2', 'JSS 3');
        $sss = array('SSS 1', 'SSS 2', 'SSS 3');

        if($type == null){
            ALert::error('Select Type', 'Select a valid examination type');
            return redirect()->back();
        }
        if($term == null){
            ALert::error('Select Term', 'Select a valid term');
            return redirect()->back();
        }
        if($session == null){
            ALert::error('Select Session', 'Select a valid session');
            return redirect()->back();
        }

        // Check payment first
        $check = DB::table('payments')->where('reg_no', $reg_no)
                                    ->where('term', $term)
                                    ->where('session', $session)->first();

        // Midterm Results Doesn't require Payment Confirmation
        if($type == 'midterm'){
            $result = DB::table('midterms')->where('reg_no', $reg_no)
                                        ->where('term', $term)
                                        ->where('session', $session)->get();

            if($result->first() != null){
                $subject_offered = DB::table('midterms')
                                            ->where('session', $session)
                                            ->where('term', $term)
                                            ->where('reg_no', $reg_no)
                                            ->whereNotNull('ts')
                                            ->count('subject');

                $total = DB::table('midterms')
                                            ->where('session', $session)
                                            ->where('term', $term)
                                            ->where('reg_no', $reg_no)
                                            ->whereNotNull('ts')
                                            ->sum('ts');

                $total_achievable = $subject_offered * 40;
                $percentage = ($total/$total_achievable) * 100;
                $percentage = round($percentage, 2);

                if(in_array($result->first()->class, $jss)){
                    $data = [
                        'type' => $type,
                        'session' => $session,
                        'term' => $term,
                        'class' => $result->first()->class
                    ];
                    return view('result-checker.jss.midterm.calculate', ['result' => $result, 'data' => $data, 'total' => $total, 'total_achievable' => $total_achievable, 'percentage' => $percentage]);
                }
                return view('result-checker.midterm', ['result' => $result, 'total' => $total, 'total_achievable' => $total_achievable, 'percentage' => $percentage]);
            }
            Alert::error("No Records", "Result not found");
            return redirect()->back();
        }

        //Examination Starts
        else{
            //Check if student is owing schoolfees

            //Results for both first and second term
            if(strtolower($term) != 'third'){
                $result = DB::table('results')->where('reg_no', $reg_no)
                                        ->where('term', $term)
                                        ->where('session', $session)->get();

                //Check if this is a secondary student result
                if($result->first() != null){
                    $subject_offered = DB::table('results')
                                        ->where('session', $session)
                                        ->where('term', $term)
                                        ->where('reg_no', $reg_no)
                                        ->whereNotNull('ts')
                                        ->count('subject');

                    $total = DB::table('results')
                                                ->where('session', $session)
                                                ->where('term', $term)
                                                ->where('reg_no', $reg_no)
                                                ->whereNotNull('ts')
                                                ->sum('ts');

                    $total_achievable = $subject_offered * 100;
                    $percentage = ($total/$total_achievable) * 100;
                    $percentage = round($percentage, 2);

                    if(in_array($result->first()->class, $jss)){
                        $data = [
                            'type' => $type,
                            'session' => $session,
                            'term' => $term,
                            'class' => $result->first()->class
                        ];
                        return view('result-checker.jss.result.calculate', ['result' => $result, 'data' => $data, 'total' => $total, 'total_achievable' => $total_achievable, 'percentage' => $percentage]);
                    }
                    if(strtoupper($result->first()->class) == 'SSS 3'){
                        return view('result-checker.sss.sssthree', ['result' => $result, 'total' => $total, 'total_achievable' => $total_achievable, 'percentage' => $percentage]);
                    }
                    return view('result-checker.sss.result', ['result' => $result, 'total' => $total, 'total_achievable' => $total_achievable, 'percentage' => $percentage]);
                }

                $result = DB::table('pryres')->where('reg_no', $reg_no)
                                        ->where('term', $term)
                                        ->where('session', $session)->get();
                if($result->first() != null){
                    $subject_offered = DB::table('pryres')
                                        ->where('session', $session)
                                        ->where('term', $term)
                                        ->where('reg_no', $reg_no)
                                        ->whereNotNull('ts')
                                        ->count('subject');

                    $total = DB::table('pryres')
                                                ->where('session', $session)
                                                ->where('term', $term)
                                                ->where('reg_no', $reg_no)
                                                ->whereNotNull('ts')
                                                ->sum('ts');

                    $total_achievable = $subject_offered * 100;
                    $percentage = ($total/$total_achievable) * 100;
                    $percentage = round($percentage, 2);

                    return view('result-checker.primary.result', ['result' => $result, 'total' => $total, 'total_achievable' => $total_achievable, 'percentage' => $percentage]);
                }
                Alert::error("No Records", "Result not found");
                return redirect()->back();

            }

            //If term is third
            else{
                $result = DB::table('results')->where('reg_no', $reg_no)
                                        ->where('term', $term)
                                        ->where('session', $session)->get();

                //Check if this is a secondary student result
                if($result->first() != null){
                    $result1 = DB::table('results')->where('reg_no', $reg_no)
                                        ->where('term', "First")
                                        ->where('session', $session)->get();

                    $result2 = DB::table('results')->where('reg_no', $reg_no)
                                        ->where('term', "Second")
                                        ->where('session', $session)->get();

                    $prev_percent = array();
                    $average_percent = 0;
                    $count = 0;
                    if($result1->first() != null){
                        $subject_offered = DB::table('results')
                                        ->where('session', $session)
                                        ->where('term', 'First')
                                        ->where('reg_no', $reg_no)
                                        ->whereNotNull('ts')
                                        ->count('subject');

                        $total = DB::table('results')
                                        ->where('session', $session)
                                        ->where('term', "First")
                                        ->where('reg_no', $reg_no)
                                        ->whereNotNull('ts')
                                        ->sum('ts');

                        $total_achievable = $subject_offered * 100;
                        $percentage = ($total/$total_achievable) * 100;
                        $percentage = round($percentage, 2);

                        $average_percent = $average_percent + $percentage;
                        $count = $count + 1;

                        $prev_percent += ["first" => $percentage];
                    }

                    if($result2->first() != null){
                        $subject_offered = DB::table('results')
                                        ->where('session', $session)
                                        ->where('term', 'Second')
                                        ->where('reg_no', $reg_no)
                                        ->whereNotNull('ts')
                                        ->count('subject');

                        $total = DB::table('results')
                                        ->where('session', $session)
                                        ->where('term', "Second")
                                        ->where('reg_no', $reg_no)
                                        ->whereNotNull('ts')
                                        ->sum('ts');

                        $total_achievable = $subject_offered * 100;
                        $percentage = ($total/$total_achievable) * 100;
                        $percentage = round($percentage, 2);

                        $average_percent = $average_percent + $percentage;
                        $count = $count + 1;

                        $prev_percent += ["second" => $percentage];
                    }

                    $subject_offered = DB::table('results')
                                        ->where('session', $session)
                                        ->where('term', $term)
                                        ->where('reg_no', $reg_no)
                                        ->whereNotNull('ts')
                                        ->count('subject');

                    $total = DB::table('results')
                                        ->where('session', $session)
                                        ->where('term', $term)
                                        ->where('reg_no', $reg_no)
                                        ->whereNotNull('ts')
                                        ->sum('ts');

                    $total_achievable = $subject_offered * 100;
                    $percentage = ($total/$total_achievable) * 100;
                    $percentage = round($percentage, 2);

                    $average_percent = $average_percent + $percentage;
                    $count = $count + 1;

                    $average_percent = $average_percent/$count;
                    $average_percent = round($average_percent, 2);

                    if(in_array($result->first()->class, $jss)){
                        $data = [
                            'type' => $type,
                            'session' => $session,
                            'term' => $term,
                            'class' => $result->first()->class
                        ];
                        return view('result-checker.jss.third.calculate', ['result' => $result, 'data' => $data, 'result1' => $result1, 'result2' => $result2, 'prev_percent' => $prev_percent, 'average_percent' => $average_percent, 'total' => $total, 'total_achievable' => $total_achievable, 'percentage' => $percentage]);
                    }
                    return view('result-checker.sss.thirdresult', ['result' => $result, 'result1' => $result1, 'result2' => $result2, 'prev_percent' => $prev_percent, 'average_percent' => $average_percent, 'total' => $total, 'total_achievable' => $total_achievable, 'percentage' => $percentage]);
                }

                //Check if it is a primary school student
                    $result = DB::table('pryres')->where('reg_no', $reg_no)
                                        ->where('term', $term)
                                        ->where('session', $session)->get();

                    if($result->first() != null){
                        $result1 = DB::table('pryres')->where('reg_no', $reg_no)
                                            ->where('term', "First")
                                            ->where('session', $session)->get();

                        $result2 = DB::table('pryres')->where('reg_no', $reg_no)
                                            ->where('term', "Second")
                                            ->where('session', $session)->get();

                        $prev_percent = array();
                        $average_percent = 0;
                        $count = 0;
                        if($result1->first() != null){
                            $subject_offered = DB::table('pryres')
                                            ->where('session', $session)
                                            ->where('term', 'First')
                                            ->where('reg_no', $reg_no)
                                            ->whereNotNull('ts')
                                            ->count('subject');

                            $total = DB::table('pryres')
                                            ->where('session', $session)
                                            ->where('term', "First")
                                            ->where('reg_no', $reg_no)
                                            ->whereNotNull('ts')
                                            ->sum('ts');

                            $total_achievable = $subject_offered * 100;
                            $percentage = ($total/$total_achievable) * 100;
                            $percentage = round($percentage, 2);

                            $average_percent = $average_percent + $percentage;
                            $count = $count + 1;

                            $prev_percent += ["first" => $percentage];
                        }

                        if($result2->first() != null){
                            $subject_offered = DB::table('pryres')
                                            ->where('session', $session)
                                            ->where('term', 'Second')
                                            ->where('reg_no', $reg_no)
                                            ->whereNotNull('ts')
                                            ->count('subject');

                            $total = DB::table('pryres')
                                            ->where('session', $session)
                                            ->where('term', "Second")
                                            ->where('reg_no', $reg_no)
                                            ->whereNotNull('ts')
                                            ->sum('ts');

                            $total_achievable = $subject_offered * 100;
                            $percentage = ($total/$total_achievable) * 100;
                            $percentage = round($percentage, 2);

                            $average_percent = $average_percent + $percentage;
                            $count = $count + 1;

                            $prev_percent += ["second" => $percentage];
                        }

                        $subject_offered = DB::table('pryres')
                                            ->where('session', $session)
                                            ->where('term', $term)
                                            ->where('reg_no', $reg_no)
                                            ->whereNotNull('ts')
                                            ->count('subject');

                        $total = DB::table('pryres')
                                            ->where('session', $session)
                                            ->where('term', $term)
                                            ->where('reg_no', $reg_no)
                                            ->whereNotNull('ts')
                                            ->sum('ts');

                        $total_achievable = $subject_offered * 100;
                        $percentage = ($total/$total_achievable) * 100;
                        $percentage = round($percentage, 2);

                        $average_percent = $average_percent + $percentage;
                        $count = $count + 1;

                        $average_percent = $average_percent/$count;
                        $average_percent = round($average_percent, 2);

                        return view('result-checker.primary.thirdresult', ['result' => $result, 'result1' => $result1, 'result2' => $result2, 'prev_percent' => $prev_percent, 'average_percent' => $average_percent, 'total' => $total, 'total_achievable' => $total_achievable, 'percentage' => $percentage]);
                    }
                }
                Alert::error("No Records", "Result not found");
                return redirect()->back();

            }
        }
        // Confirm if payment has been made
}

