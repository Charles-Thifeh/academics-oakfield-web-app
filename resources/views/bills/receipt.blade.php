<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $payment->reg_no }} {{ $payment->term }} {{ $payment->session }} Receipt</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <script type="text/javascript">
        setTimeout(() => { window.addEventListener("load", window.print()); }, 5000);

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
                    <h3 class="text-xl font-extrabold">{{$payment->session}}, {{$payment->term}} Receipt</h3>
                    <table class="w-full text-left border-collapse border border-slate-500 text-sm">
                        <thead>
                        <tr class="py-2 px-4 font-semibold">
                            <th class="border border-slate-500" colspan="2">Name: {{$surname}} {{$firstname}}</th>
                            <th class="border border-slate-500">Reg_no: {{$reg_no}}</th>
                            <th class="border border-slate-500">Receipt ID: {{$receipt->receiptID}}</th>
                        </tr>
                        <tr class="py-2 px-4 font-semibold">
                            <th class="border border-slate-500">Class: {{ $payment->class }}</th>
                            <th class="border border-slate-500">Payment Method: {{ $transaction->details }}</th>
                            <th class="border border-slate-500">Term: {{ $payment->term }}</th>
                            <th class="border border-slate-500">Session: {{ $payment->session }}</th>
                        </tr>
                        </thead>
                    </table>
                    <table class="w-full my-4 text-left border-collapse border border-slate-500">
                        <thead>
                            <tr class="py-2 px-4 font-semibold text-sm">
                                <th class="border border-slate-500">Description</th>
                                <th class="border border-slate-500">{{ strtoupper($payment->type) }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="py-2 px-4 text-sm">
                                <td class="border border-slate-500">Amount Paid</td>
                                <td class="border border-slate-500 text-green-700">{{ $transaction->amount }}</td>
                            </tr>

                            <tr class="py-2 px-4 text-sm">
                                <td class="border border-slate-500">Balance</td>
                                <td class="border border-slate-500 text-red-600">{{ $payment->payableamount - $payment->amountpaid }}</td>
                            </tr>

                            <tr class="py-2 px-4 text-sm">
                                <td class="border border-slate-500">Total Amount Paid</td>
                                <td class="border border-slate-500 text-green-700">{{ $payment->amountpaid }}</td>
                            </tr>

                            <tr class="py-2 px-4 text-sm">
                                <td class="border border-slate-500">Total Bill</td>
                                <td class="border border-slate-500 font-bold">{{ $payment->payableamount }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="flex justify-between">
                        <table class="w-3/6 my-4 text-left border-collapse border border-slate-500 text-sm font-semibold">
                            <tbody>
                                <tr class="py-2 px-4 text-sm">
                                    <td class="border border-slate-500 w-1/3">Bursar</td>
                                    <td class="border border-slate-500">Mrs Olasupo</td>
                                </tr>
                                <tr class="py-2 px-4 text-sm">
                                    <td class="border border-slate-500 w-1/3">Bursar Signature</td>
                                    <td class="border border-slate-500 h-24"></td>
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
