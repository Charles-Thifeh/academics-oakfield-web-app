
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
    <style>
        input[type="radio"]:checked+span {
            display: block;
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Teachers') }}
        </h2>
    </x-slot>

    <div class="container mx-auto">
        <div class="p-5 mx-auto my-10 bg-white rounded-md shadow-sm">
            <div class="flex justify-between px-10">
                <div class="flex w-full justify-start">
                    <a href="{{ route('admin-student') }}">
                        <button class="px-4 py-4 text-white bg-red-500 rounded-md  hover:bg-red-600 hover:outline-none">
                            <- Back </button>
                    </a>
                </div>

                <div class="flex w-full justify-end">
                    <a href="{{ route('admin-student-add') }}">
                        <button
                            class="px-4 py-4 text-white bg-green-500 rounded-md  hover:bg-green-600 hover:outline-none"
                            id="open-btn">
                            Add New Student
                        </button>
                    </a>

                </div>

            </div>


            {{-- Invoice starts --}}
            <div class="w-full mt-12 py-2 px-4 text-xl">
                <div class="text-black text-center w-full my-2 py-2 px-4">
                    <h3 class="text-2xl font-extrabold">{{ $students->first()->class }} Class List</h3>
                    <h4 class="text-xl font-semibold">Status: {{ $status }}</h4>

                    <div class="w-full flex justify-end py-8">
                        <input type="text" id="myInput"
                            class="block w-72 py-3 pl-4 pr-8 bg-white border border-gray-300 rounded-sm appearance-none cursor-pointer focus:outline-none hover:border-gray-400"
                            onkeyup="myFunction()" placeholder="Search for names..">
                    </div>

                    <table id="myTable" class="w-full text-left border-collapse border border-slate-500">
                        <thead>
                            <tr class="py-2 px-4 font-semibold">
                                <th class="border border-slate-500">S/N</th>
                                <th class="border border-slate-500">Full Name</th>
                                <th class="border border-slate-500">Reg No</th>
                                <th class="border border-slate-500">Class</th>
                                <th class="border border-slate-500">Department</th>
                                <th class="border border-slate-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($students as $item)
                                <tr class="py-2 px-4">
                                    <td class="border border-slate-500">{{ $i = $i + 1 }}</td>
                                    <td class="border border-slate-500">
                                        {{ $item->surname }} {{ $item->firstname }}
                                        <p class="text-sm text-end">

                                        </p>
                                    </td>
                                    <td class="border border-slate-500">{{ $item->reg_no }}
                                        @if ($item->status == 'active')
                                                <button
                                                    class="text-xs h-4 px-2 text-white bg-green-500 rounded-md  hover:bg-red-600 hover:outline-none">
                                                    Active
                                                </button>
                                            @elseif($item->status == 'inactive')
                                                <button
                                                    class="text-xs h-4 px-2 text-white bg-red-500 rounded-md  hover:bg-red-600 hover:outline-none">
                                                    Inactive
                                                </button>
                                            @else
                                                <button
                                                    class="text-xs h-4 px-2 text-white bg-green-500 rounded-md  hover:bg-red-600 hover:outline-none">
                                                    Graduated
                                                </button>
                                            @endif
                                    </td>
                                    <td class="border border-slate-500">{{ $item->class }}</td>
                                    <td class="border border-slate-500">{{ $item->dept }}</td>

                                    <td class="border border-slate-500 w-32">
                                        <div class="flex gap-2 py-2 px-4">
                                            <div class="">
                                                <form action="{{ route('admin-student-edit') }}" method="GET">
                                                    @csrf
                                                    <input type="hidden" name="vim" value="{{ $item->id }}">
                                                    <button details="Edit details and class"
                                                        class="text-xs h-8 px-4 text-white bg-blue-500 rounded-md  hover:bg-blue-600 hover:outline-none">
                                                        Edit
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="">
                                                <form action="{{ route('admin-student-status') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="vim" value="{{ $item->id }}">
                                                    <button
                                                        class="text-xs h-8 px-4 text-white bg-orange-500 rounded-md  hover:bg-orange-600 hover:outline-none">
                                                        Change Status
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="">
                                                <button
                                                    class="text-xs h-8 px-4 text-white bg-red-500 rounded-md  hover:bg-red-600 hover:outline-none">
                                                    Delete
                                                </button>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        {{-- <div class="py-4">
                            {{ $students->links() }}
                        </div> --}}
                    </table>


                </div>

            </div>
            {{-- Invoice ends --}}
        </div>


    </div>

    <script>
        function myFunction() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>


    <script>
        let modal = document.getElementById('modal');
        let btn = document.getElementById('open-btn');
        let button = document.getElementById('ok-btn');

        btn.onclick = function() {
            modal.style.display = 'block';
        };

        button.onclick = function() {
            modal.style.display = 'none';
        };

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>
</html>
