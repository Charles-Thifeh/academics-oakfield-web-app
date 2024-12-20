<x-app-layout>
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
                    <a href="{{ route('dashboard') }}">
                        <button class="px-4 py-4 text-white bg-red-500 rounded-md  hover:bg-red-600 hover:outline-none">
                            <- Dashboard </button>
                    </a>
                </div>

                <div class="flex w-full justify-end">
                    <a href="{{ route('admin-teacher-add') }}">
                        <button
                            class="px-4 py-4 text-white bg-green-500 rounded-md  hover:bg-green-600 hover:outline-none"
                            id="open-btn">
                            Add New Teacher
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

                    <table id="myTable" class="w-full text-left border-collapse border border-slate-500">
                        <thead>
                            <tr class="py-2 px-4 font-semibold">
                                <th class="border border-slate-500">S/N</th>
                                <th class="border border-slate-500">Full Name</th>
                                <th class="border border-slate-500">ID</th>
                                <th class="border border-slate-500">Class</th>
                                <th class="border border-slate-500">Subjects</th>
                                <th class="border border-slate-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($teachers as $item)
                                @php
                                    $subjects = DB::table('subtables')
                                        ->select('subject', 'level')
                                        ->where('teacher_id', $item->teacher_id)
                                        ->get();
                                @endphp
                                <tr class="py-2 px-4">
                                    <td class="border border-slate-500">{{ $i = $i + 1 }}</td>
                                    <td class="border border-slate-500">
                                        {{ $item->surname }} {{ $item->firstname }}
                                        <p class="text-sm">
                                        </p>
                                    </td>
                                    <td class="border border-slate-500">{{ $item->teacher_id }}</td>
                                    <td class="border border-slate-500">{{ $item->class }}</td>
                                    <td class="border border-slate-500">
                                        @if ($subjects->first() != null)
                                            @foreach ($subjects as $subject)
                                                <p class="text-sm">
                                                    {{ $subject->subject }} [{{ $subject->level }}]
                                                </p>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="border border-slate-500 w-32">
                                        <div class="flex gap-2 py-2 px-4">
                                            <div class="">
                                                <form action="{{ route('admin-teacher-edit') }}" method="GET">
                                                    @csrf
                                                    <input type="hidden" name="vim" value="{{ $item->id }}">
                                                    <button details="Edit details and class"
                                                        class="text-xs h-8 px-4 text-white bg-blue-500 rounded-md  hover:bg-blue-600 hover:outline-none">
                                                        Edit
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="">
                                                <form action="{{ route('admin-teacher-subject') }}" method="GET">
                                                    @csrf
                                                    <input type="hidden" name="vim" value="{{ $item->id }}">
                                                    <button
                                                        class="text-xs h-8 px-4 text-white bg-orange-500 rounded-md  hover:bg-orange-600 hover:outline-none">
                                                        Subject
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
                        <div class="py-4">
                            {{ $teachers->links() }}
                        </div>
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
</x-app-layout>
