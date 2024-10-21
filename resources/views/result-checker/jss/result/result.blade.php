<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $result->first()->reg_no }} {{ $result->first()->term }} {{ $result->first()->session }} Result</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <script type="text/javascript">
        window.addEventListener("load", window.print());
   </script>
    <body class="font-sans antialiased">
        @include('sweetalert::alert')
        {{-- @include('result-checker.jss.calculate') --}}
        @php
            $surname = DB::table("students")->where("id", Auth::id())->first()->surname;
            $firstname = DB::table("students")->where("id", Auth::id())->first()->firstname;
            $reg_no = DB::table("students")->where("id", Auth::id())->first()->reg_no;

            //date in mm/dd/yyyy format; or it can be in other formats as well
            $birthDate = DB::table('students')
                        ->where('reg_no', $reg_no)->first()->DoB;
            //explode the date to get month, day and year
            if ($birthDate != null){
                $birthDate = explode("-", $birthDate);
                //get age from date or birthdate
                $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md")
                                                    ? ((date("Y") - $birthDate[0]) - 1) : (date("Y") - $birthDate[0]));
            }
            else {
                $age = " ";
            }
        @endphp

        <div class="flex justify-center">
            <div class="w-full mt-12 py-2 px-4 text-xl">
                <div class="flex my-4">
                    <div class="w-full flex justify-between">
                        <div>
                            <x-application-logo class="w-30 h-20 fill-current text-gray-500" />
                        </div>
                        <div>
                            <h2 class="text-xl font-bold">
                                OAKFIELD SCHOOLS
                            </h2>
                            <h4 class="text-sm italic">Nursery, Primary and Secondary</h4>
                            <h4 class="text-sm ">ORIMERUNMU ROAD, ORIMERUNMU, OGUN STATE</h4>
                            <h4 class="text-sm italic">The Preferred....</h4>
                        </div>
                    </div>
                </div>
                <div class="text-black text-center w-full my-2 py-2 px-4">
                    <h3 class="text-xl font-extrabold">{{$result->first()->session}}, {{$result->first()->term}} Term Report Sheet</h3>
                    <table class="w-full text-left border-collapse border border-slate-500 text-sm">
                        <thead>
                            <tr class="py-2 px-4 font-semibold">
                                <th class="border border-slate-500" colspan="2">Name: {{$surname}} {{$firstname}}</th>
                                <th class="border border-slate-500" colspan="2">Reg_no: {{$reg_no}}</th>
                            </tr>
                            <tr class="py-2 px-4 font-semibold">
                                <th class="border border-slate-500">Class: {{ $result->first()->class }}</th>
                                <th class="border border-slate-500">Age: {{ $age }}</th>
                                <th class="border border-slate-500">Term: {{ $result->first()->term }}</th>
                                <th class="border border-slate-500">Session: {{ $result->first()->session }}</th>
                            </tr>
                        </thead>
                    </table>

                    <table class="w-full my-4 text-left border-collapse border border-slate-500">
                        <thead>
                            <tr class="py-2 px-4 font-semibold text-sm">
                                <th class="border border-slate-500">Subjects</th>
                                <th class="border border-slate-500">Midterm (10)</th>
                                <th class="border border-slate-500">C.A (20)</th>
                                <th class="border border-slate-500">Exam (70)</th>
                                <th class="border border-slate-500">Total (100)</th>
                                <th class="border border-slate-500">Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="py-2 px-4 text-sm">
                                <td class="border border-slate-500">English Language</td>
                                <td class="border border-slate-500">{{ $eng_mt }}</td>
                                <td class="border border-slate-500">{{ $eng_ca }}</td>
                                <td class="border border-slate-500">{{ $eng_ex }}</td>
                                <td class="border border-slate-500">{{ $eng_ts }}</td>
                                <td class="border border-slate-500">
                                    @if (($eng_ts > 74) && ($eng_ts <= 100))
                                        A
                                    @endif
                                    @if (($eng_ts > 59) && ($eng_ts < 75))
                                        B
                                    @endif
                                    @if (($eng_ts > 49) && ($eng_ts < 60))
                                        C
                                    @endif
                                    @if (($eng_ts >= 0) && ($eng_ts < 50))
                                        F
                                    @endif
                                </td>
                            </tr>

                            <tr class="py-2 px-4 text-sm">
                                <td class="border border-slate-500">Mathematics</td>
                                <td class="border border-slate-500">{{ $mat->mt }}</td>
                                <td class="border border-slate-500">{{ $mat->ca }}</td>
                                <td class="border border-slate-500">{{ $mat->ex }}</td>
                                <td class="border border-slate-500">{{ $mat->ts }}</td>
                                <td class="border border-slate-500">
                                    @if (($mat->ts > 74) && ($mat->ts <= 100))
                                        A
                                    @endif
                                    @if (($mat->ts > 59) && ($mat->ts < 75))
                                        B
                                    @endif
                                    @if (($mat->ts > 49) && ($mat->ts < 60))
                                        C
                                    @endif
                                    @if (($mat->ts >= 0) && ($mat->ts < 50))
                                        F
                                    @endif
                                </td>
                            </tr>


                            <tr class="py-2 px-4 text-sm">
                                <td class="border border-slate-500">Basic Science and Technology</td>
                                <td class="border border-slate-500">{{ $bst_mt }}</td>
                                <td class="border border-slate-500">{{ $bst_ca }}</td>
                                <td class="border border-slate-500">{{ $bst_ex }}</td>
                                <td class="border border-slate-500">{{ $bst_ts }}</td>
                                <td class="border border-slate-500">
                                    @if (($bst_ts > 74) && ($bst_ts <= 100))
                                        A
                                    @endif
                                    @if (($bst_ts > 59) && ($bst_ts < 75))
                                        B
                                    @endif
                                    @if (($bst_ts > 49) && ($bst_ts < 60))
                                        C
                                    @endif
                                    @if (($bst_ts >= 0) && ($bst_ts < 50))
                                        F
                                    @endif
                                </td>
                            </tr>

                            <tr class="py-2 px-4 text-sm">
                                <td class="border border-slate-500">Creative and Cultural Art</td>
                                <td class="border border-slate-500">{{ $cc_mt }}</td>
                                <td class="border border-slate-500">{{ $cc_ca }}</td>
                                <td class="border border-slate-500">{{ $cc_ex }}</td>
                                <td class="border border-slate-500">{{ $cc_ts }}</td>
                                <td class="border border-slate-500">
                                    @if (($cc_ts > 74) && ($cc_ts <= 100))
                                        A
                                    @endif
                                    @if (($cc_ts > 59) && ($cc_ts < 75))
                                        B
                                    @endif
                                    @if (($cc_ts > 49) && ($cc_ts < 60))
                                        C
                                    @endif
                                    @if (($cc_ts >= 0) && ($cc_ts < 50))
                                        F
                                    @endif
                                </td>
                            </tr>

                            <tr class="py-2 px-4 text-sm">
                                <td class="border border-slate-500">National Values Education</td>
                                <td class="border border-slate-500">{{ $nve_mt }}</td>
                                <td class="border border-slate-500">{{ $nve_ca }}</td>
                                <td class="border border-slate-500">{{ $nve_ex }}</td>
                                <td class="border border-slate-500">{{ $nve_ts }}</td>
                                <td class="border border-slate-500">
                                    @if (($nve_ts > 74) && ($nve_ts <= 100))
                                        A
                                    @endif
                                    @if (($nve_ts > 59) && ($nve_ts < 75))
                                        B
                                    @endif
                                    @if (($nve_ts > 49) && ($nve_ts < 60))
                                        C
                                    @endif
                                    @if (($nve_ts >= 0) && ($nve_ts < 50))
                                        F
                                    @endif
                                </td>
                            </tr>

                            <tr class="py-2 px-4 text-sm">
                                <td class="border border-slate-500">Pro-Vocational Studies</td>
                                <td class="border border-slate-500">{{ $pvs_mt }}</td>
                                <td class="border border-slate-500">{{ $pvs_ca }}</td>
                                <td class="border border-slate-500">{{ $pvs_ex }}</td>
                                <td class="border border-slate-500">{{ $pvs_ts }}</td>
                                <td class="border border-slate-500">
                                    @if (($pvs_ts > 74) && ($pvs_ts <= 100))
                                        A
                                    @endif
                                    @if (($pvs_ts > 59) && ($pvs_ts < 75))
                                        B
                                    @endif
                                    @if (($pvs_ts > 49) && ($pvs_ts < 60))
                                        C
                                    @endif
                                    @if (($pvs_ts >= 0) && ($pvs_ts < 50))
                                        F
                                    @endif
                                </td>
                            </tr>

                            <tr class="py-2 px-4 text-sm">
                                <td class="border border-slate-500">French</td>
                                <td class="border border-slate-500">{{ $fr->mt }}</td>
                                <td class="border border-slate-500">{{ $fr->ca }}</td>
                                <td class="border border-slate-500">{{ $fr->ex }}</td>
                                <td class="border border-slate-500">{{ $fr->ts }}</td>
                                <td class="border border-slate-500">
                                    @if (($fr->ts > 74) && ($fr->ts <= 100))
                                        A
                                    @endif
                                    @if (($fr->ts > 59) && ($fr->ts < 75))
                                        B
                                    @endif
                                    @if (($fr->ts > 49) && ($fr->ts < 60))
                                        C
                                    @endif
                                    @if (($fr->ts >= 0) && ($fr->ts < 50))
                                        F
                                    @endif
                                </td>
                            </tr>

                            <tr class="py-2 px-4 text-sm">
                                <td class="border border-slate-500">Yoruba</td>
                                <td class="border border-slate-500">{{ $yo->mt }}</td>
                                <td class="border border-slate-500">{{ $yo->ca }}</td>
                                <td class="border border-slate-500">{{ $yo->ex }}</td>
                                <td class="border border-slate-500">{{ $yo->ts }}</td>
                                <td class="border border-slate-500">
                                    @if (($yo->ts > 74) && ($yo->ts <= 100))
                                        A
                                    @endif
                                    @if (($yo->ts > 59) && ($yo->ts < 75))
                                        B
                                    @endif
                                    @if (($yo->ts > 49) && ($yo->ts < 60))
                                        C
                                    @endif
                                    @if (($yo->ts >= 0) && ($yo->ts < 50))
                                        F
                                    @endif
                                </td>
                            </tr>

                            <tr class="py-2 px-4 text-sm">
                                <td class="border border-slate-500">Business Studies</td>
                                <td class="border border-slate-500">{{ $bus->mt }}</td>
                                <td class="border border-slate-500">{{ $bus->ca }}</td>
                                <td class="border border-slate-500">{{ $bus->ex }}</td>
                                <td class="border border-slate-500">{{ $bus->ts }}</td>
                                <td class="border border-slate-500">
                                    @if (($bus->ts > 74) && ($bus->ts <= 100))
                                        A
                                    @endif
                                    @if (($bus->ts > 59) && ($bus->ts < 75))
                                        B
                                    @endif
                                    @if (($bus->ts > 49) && ($bus->ts < 60))
                                        C
                                    @endif
                                    @if (($bus->ts >= 0) && ($bus->ts < 50))
                                        F
                                    @endif
                                </td>
                            </tr>

                            <tr class="py-2 px-4 text-sm">
                                <td class="border border-slate-500">Christian Religious Studies</td>
                                <td class="border border-slate-500">{{ $crs->mt }}</td>
                                <td class="border border-slate-500">{{ $crs->ca }}</td>
                                <td class="border border-slate-500">{{ $crs->ex }}</td>
                                <td class="border border-slate-500">{{ $crs->ts }}</td>
                                <td class="border border-slate-500">
                                    @if (($crs->ts > 74) && ($crs->ts <= 100))
                                        A
                                    @endif
                                    @if (($crs->ts > 59) && ($crs->ts < 75))
                                        B
                                    @endif
                                    @if (($crs->ts > 49) && ($crs->ts < 60))
                                        C
                                    @endif
                                    @if (($crs->ts >= 0) && ($crs->ts < 50))
                                        F
                                    @endif
                                </td>
                            </tr>

                            <tr class="py-2 px-4 text-sm">
                                <td class="border border-slate-500">Diction</td>
                                <td class="border border-slate-500">{{ $dic->mt }}</td>
                                <td class="border border-slate-500">{{ $dic->ca }}</td>
                                <td class="border border-slate-500">{{ $dic->ex }}</td>
                                <td class="border border-slate-500">{{ $dic->ts }}</td>
                                <td class="border border-slate-500">
                                    @if (($dic->ts > 74) && ($dic->ts <= 100))
                                        A
                                    @endif
                                    @if (($dic->ts > 59) && ($dic->ts < 75))
                                        B
                                    @endif
                                    @if (($dic->ts > 49) && ($dic->ts < 60))
                                        C
                                    @endif
                                    @if (($dic->ts >= 0) && ($dic->ts < 50))
                                        F
                                    @endif
                                </td>
                            </tr>

                            <tr class="py-2 px-4 text-sm">
                                <td class="border border-slate-500">History</td>
                                <td class="border border-slate-500">{{ $his->mt }}</td>
                                <td class="border border-slate-500">{{ $his->ca }}</td>
                                <td class="border border-slate-500">{{ $his->ex }}</td>
                                <td class="border border-slate-500">{{ $his->ts }}</td>
                                <td class="border border-slate-500">
                                    @if (($his->ts > 74) && ($his->ts <= 100))
                                        A
                                    @endif
                                    @if (($his->ts > 59) && ($his->ts < 75))
                                        B
                                    @endif
                                    @if (($his->ts > 49) && ($his->ts < 60))
                                        C
                                    @endif
                                    @if (($his->ts >= 0) && ($his->ts < 50))
                                        F
                                    @endif
                                </td>
                            </tr>

                        </tbody>
                    </table>

                    <div class="flex justify-between">
                        <table class="w-3/6 my-4 text-left border-collapse border border-slate-500 text-sm font-semibold">
                            <tbody>
                                <tr class="py-2 px-4 text-sm">
                                    <td class="border border-slate-500 w-1/3">Total Mark</td>
                                    <td class="border border-slate-500">{{ $total }}</td>
                                </tr>
                                <tr class="py-2 px-4 text-sm">
                                    <td class="border border-slate-500 w-1/3">Achievable Mark</td>
                                    <td class="border border-slate-500">{{ $total_achievable }}</td>
                                </tr>
                                <tr class="py-2 px-4 text-sm">
                                    <td class="border border-slate-500 w-1/3">Percentage</td>
                                    <td class="border border-slate-500">{{ $percentage }}%</td>
                                </tr>
                                <tr class="py-2 px-4 text-sm">
                                    <td class="border border-slate-500 w-1/3">Remarks</td>
                                    <td class="border border-slate-500">
                                        @if (($percentage > 74) && ($percentage < 101))
                                            A
                                        @endif
                                        @if (($percentage > 59) && ($percentage < 75))
                                            B
                                        @endif
                                        @if (($percentage > 49) && ($percentage < 60))
                                            C
                                        @endif
                                        @if (($percentage >= 0) && ($percentage < 50))
                                            F
                                        @endif
                                    </td>
                                </tr>
                                <tr class="py-2 px-4 text-sm">
                                    <td class="border border-slate-500 w-1/3">Teacher's Comments</td>
                                    <td class="border border-slate-500 h-24"></td>
                                </tr>
                                <tr class="py-2 px-4 text-sm">
                                    <td class="border border-slate-500 w-1/3">Principal's Comments</td>
                                    <td class="border border-slate-500 h-24"></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="w-2/6 my-4 text-center border-collapse border border-slate-500 text-sm">
                            <thead>
                                <tr class="py-2 px-4 font-semibold text-sm">
                                    <th class="border border-slate-500" colspan="2">Grading System</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="py-2 px-4 text-sm font-semibold">
                                    <td class="border border-slate-500 w-1/2">A</td>
                                    <td class="border border-slate-500 w-1/2">75 - 100</td>
                                </tr>
                                <tr class="py-2 px-4 text-sm font-semibold">
                                    <td class="border border-slate-500 w-1/2">B</td>
                                    <td class="border border-slate-500 w-1/2">60 - 74</td>
                                </tr>
                                <tr class="py-2 px-4 text-sm font-semibold">
                                    <td class="border border-slate-500 w-1/2">C</td>
                                    <td class="border border-slate-500 w-1/2">50 - 59</td>
                                </tr>
                                <tr class="py-2 px-4 text-sm font-semibold">
                                    <td class="border border-slate-500 w-1/2">F</td>
                                    <td class="border border-slate-500 w-1/2">0 - 49</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </body>
</html>
