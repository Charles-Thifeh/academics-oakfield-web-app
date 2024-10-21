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
            ? ((date("Y") - $birthDate[0]) - 1)
            : (date("Y") - $birthDate[0]));
            } else {
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
                    <h3 class="text-xl font-extrabold">{{$result->first()->session}}, {{$result->first()->term}} Mid-Term Report Sheet</h3>
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
                                <th class="border border-slate-500">Test (10)</th>
                                <th class="border border-slate-500">C.A (30)</th>
                                <th class="border border-slate-500">Total (40)</th>
                                <th class="border border-slate-500">Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($result as $item)
                                @if ($item->ts == null)

                                @else
                                    <tr class="py-2 px-4 text-sm">
                                        <td class="border border-slate-500">{{ $item->subject }}</td>
                                        <td class="border border-slate-500">{{ $item->at }}</td>
                                        <td class="border border-slate-500">{{ $item->ex }}</td>
                                        <td class="border border-slate-500">{{ $item->ts }}</td>
                                        <td class="border border-slate-500">
                                            @if (($item->ts > 29) && ($item->ts <= 40))
                                                A
                                            @endif
                                            @if (($item->ts > 24) && ($item->ts < 30))
                                                B
                                            @endif
                                            @if (($item->ts > 19) && ($item->ts < 25))
                                                C
                                            @endif
                                            @if (($item->ts >= 0) && ($item->ts < 20))
                                                F
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
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
                                    <td class="border border-slate-500 w-1/3">Principal/Head Teacher's Comments</td>
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
                                    <td class="border border-slate-500 w-1/2">30 - 40</td>
                                </tr>
                                <tr class="py-2 px-4 text-sm font-semibold">
                                    <td class="border border-slate-500 w-1/2">B</td>
                                    <td class="border border-slate-500 w-1/2">25 - 29</td>
                                </tr>
                                <tr class="py-2 px-4 text-sm font-semibold">
                                    <td class="border border-slate-500 w-1/2">C</td>
                                    <td class="border border-slate-500 w-1/2">20 - 24</td>
                                </tr>
                                <tr class="py-2 px-4 text-sm font-semibold">
                                    <td class="border border-slate-500 w-1/2">F</td>
                                    <td class="border border-slate-500 w-1/2">0 - 19</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </body>
</html>
