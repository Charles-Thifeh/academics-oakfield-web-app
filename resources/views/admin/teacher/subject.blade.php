<x-app-layout>
    <style>
        input[type="radio"]:checked+span {
            display: block;
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Subjects') }}
        </h2>
    </x-slot>

    <div class="container mx-auto">
        <div class="p-5 mx-auto my-10 bg-white rounded-md shadow-sm">
            <div class="flex justify-between px-10">
                <div class="flex w-full justify-start">
                    <a href="{{ route('admin-teacher') }}">
                        <button class="px-4 py-4 text-white bg-red-500 rounded-md  hover:bg-red-600 hover:outline-none">
                            <- Teachers
                        </button>
                    </a>
                </div>



            </div>


            {{-- Invoice starts --}}
            <div class="w-full mt-12 py-2 px-4 text-xl">
                <div class="text-black text-center w-full my-2 py-2 px-4">
                    <h3 class="text-2xl font-extrabold">Teacher's List</h3>

                    <div class="w-full flex justify-end py-8">
                        <input type="text" id="myInput"
                            class="block w-72 py-3 pl-4 pr-8 bg-white border border-gray-300 rounded-sm appearance-none cursor-pointer focus:outline-none hover:border-gray-400"
                            onkeyup="myFunction()" placeholder="Search for names..">
                    </div>

                    <div class="flex justify-between gap-8">

                        <div class="md:w-1/2 p-5 mx-auto my-10 bg-white rounded-md shadow-sm">
                            <div class="text-center">
                                <h1 class="my-3 text-3xl font-semibold text-gray-700">{{ 'Add Subject' }}</h1>
                                <p class="text-gray-400">Fill in the correct details</p>
                            </div>
                            <div>
                                <form class="mt-8" action="{{ route('admin-teacher-subject-store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $subjects->first()->teacher_id }}">
                                    <div class="mb-6">
                                        <label class="inline-block text-sm text-gray-600" for="color">Subject</label>
                                        <div class="relative flex w-full">
                                            <input name="subject" type="text"
                                                class="block w-full py-3 pl-4 pr-8 bg-white border border-gray-300 rounded-sm appearance-none cursor-pointer focus:outline-none hover:border-gray-400"
                                                placeholder="Subject">

                                        </div>
                                    </div>

                                    <div class="mb-6">
                                        <label class="inline-block text-sm text-gray-600" for="color">Select
                                            Level</label>
                                        <div class="relative flex w-full">
                                            <select name="level"
                                                class="block w-full py-3 pl-4 pr-8 bg-white border border-gray-300 rounded-sm appearance-none cursor-pointer focus:outline-none hover:border-gray-400">
                                                <option disabled selected>Select Class</option>
                                                <option>SSS</option>
                                                <option>JSS</option>
                                                <option>Primary</option>

                                            </select>
                                            <div
                                                class="absolute inset-y-0 right-0 flex items-center px-2 text-green-400 pointer-events-none">
                                                <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-6">
                                        <label class="inline-block text-sm text-gray-600" for="color">Select
                                            Department</label>
                                        <div class="relative flex w-full">
                                            <select name="department"
                                                class="block w-full py-3 pl-4 pr-8 bg-white border border-gray-300 rounded-sm appearance-none cursor-pointer focus:outline-none hover:border-gray-400">
                                                <option disabled selected>Select Department</option>
                                                <option>Science</option>
                                                <option>Commercial</option>
                                                <option>Art</option>

                                            </select>
                                            <div
                                                class="absolute inset-y-0 right-0 flex items-center px-2 text-green-400 pointer-events-none">
                                                <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="mb-6">
                                        <button type="submit"
                                            class="w-full px-2 py-4 text-white bg-green-500 rounded-md  focus:bg-green-600 focus:outline-none">
                                            Add
                                        </button>
                                    </div>
                                </form>
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="h-32 w-full bg-red-300 text-black py-8 px-2">{{ $error }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>


                        <table id="myTable" class="w-full text-left border-collapse border border-slate-500">
                            <thead>
                                <tr class="py-2 px-4 font-semibold">
                                    <th class="border border-slate-500">S/N</th>
                                    <th class="border border-slate-500">Subject</th>
                                    <th class="border border-slate-500">Level</th>
                                    <th class="border border-slate-500">Department</th>
                                    <th class="border border-slate-500">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($subjects as $item)

                                    <tr class="py-2 px-4">
                                        <td class="border border-slate-500">{{ $i = $i + 1 }}</td>
                                        <td class="border border-slate-500">
                                            {{ $item->subject }}
                                        </td>
                                        <td class="border border-slate-500">{{ $item->level }}</td>
                                        <td class="border border-slate-500">{{ $item->department }}</td>

                                        <td class="border border-slate-500 w-32">
                                            <div class="flex gap-2 py-2 px-4">
                                                <div class="">
                                                    <form action="{{ route('admin-teacher-subject-destroy') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="vim"
                                                            value="{{ $item->id }}">
                                                        <button
                                                            class="text-xs h-8 px-4 text-white bg-red-500 rounded-md  hover:bg-red-600 hover:outline-none">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>



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
</x-app-layout>
