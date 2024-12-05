{{-- @foreach ($results as $record)
    @php
        var_dump($record)
    @endphp
@endforeach --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Upload Results</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    @include('sweetalert::alert')

    @php

    @endphp
<div class="flex w-full justify-start">
    <a href="{{ route('dashboard') }}">
        <button class="px-4 py-4 text-white bg-red-500 rounded-md  hover:bg-red-600 hover:outline-none">
            <- Dashboard </button>
    </a>
</div>
    <div class="flex justify-center mt-8">
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
                <h3 class="text-xl font-extrabold">{{ $results->first()->session }}, {{ $results->first()->term }} Term
                    Final Results</h3>
                <table class="w-full text-left border-collapse border border-slate-500 text-sm">
                    <thead>
                        <tr class="py-2 px-4 font-semibold">
                            <th class="border border-slate-500" colspan="2">Subject: {{ $results->first()->subject }}
                            </th>
                            <th class="border border-slate-500" colspan="2">Class: {{ $results->first()->class }}
                            </th>
                        </tr>

                    </thead>
                </table>
                <table class="w-full my-4 text-left border-collapse border border-slate-500">
                    <thead>
                        <tr class="py-2 px-4 font-semibold text-sm">
                            <th class="border border-slate-500">S/N</th>
                            <th class="border border-slate-500">Name</th>
                            <th class="border border-slate-500">Reg_no</th>
                            <th class="border border-slate-500">Test(40)</th>
                            <th class="border border-slate-500">Exams(60)</th>
                            <th class="border border-slate-500">Total(100)</th>

                        </tr>
                    </thead>
                    <form action="{{ route('upload-query-primary-post') }}" method="POST">
                        @csrf
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($results as $record)
                                <tr class="py-2 px-4 text-sm">
                                    <td class="border border-slate-500">{{ $i = $i + 1 }}</td>
                                    <td class="border border-slate-500">
                                        {{ DB::table('students')->where('reg_no', $record->reg_no)->first()->surname }}
                                        {{ DB::table('students')->where('reg_no', $record->reg_no)->first()->firstname }}
                                    </td>
                                    <td class="border border-slate-500 text-green-700">{{ $record->reg_no }}</td>
                                    @php
                                        $mt = $record->mt;
                                        if($record->mt == null){
                                            $mt = DB::table('midterms')->where([
                                            "reg_no" => $record->reg_no,
                                            "term" => $record->term,
                                            "session" => $record->session,
                                            "subject" => $record->subject,
                                            ])->first();
                                            if($mt != null){
                                                $mt = $mt->ts;
                                            }
                                        }
                                    @endphp
                                    <td class="border border-slate-500">
                                        <input name="records[]" type="text" value="{{ $record->id }}" hidden>
                                        <input type="number" class="border-2 border-green-500" name="records[]"
                                            id="" value="{{ $mt }}" max="40">
                                    </td>
                                    <td class="border border-slate-500">
                                        <input type="number" class="border-2 border-green-500" name="records[]"
                                            id="" value="{{ $record->ex }}" max="60">
                                    </td>
                                    <td class="border border-slate-500 font-semibold text-lg">
                                        {{ $record->ts }}
                                    </td>
                                </tr>
                            @endforeach

                            <tr class="py-2 px-4 text-sm">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button type="submit"
                                        class="w-full px-2 py-4 text-white bg-green-500 rounded-md  focus:bg-green-600 focus:outline-none">
                                        Upload
                                    </button>
                                </td>
                            </tr>

                        </tbody>
                    </form>
                </table>

                <div class="flex justify-between">
                    <table class="w-3/6 my-4 text-left border-collapse border border-slate-500 text-sm font-semibold">
                        <tbody>

                            <tr class="py-2 px-4 text-sm">
                                <td class="border border-slate-500 w-1/3">Teacher's Name: </td>
                                <td class="border border-slate-500">
                                    {{ DB::table('subjects')->where('id', Auth::id())->first()->surname }}
                                    {{ DB::table('subjects')->where('id', Auth::id())->first()->firstname }}<br>
                                    {{ DB::table('subjects')->where('id', Auth::id())->first()->teacher_id }}

                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div>
                        <small class="italic">created by tic atelier</small>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>
