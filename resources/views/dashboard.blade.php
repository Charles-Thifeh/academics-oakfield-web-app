<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @php
        $class = DB::table('subjects')->where('id', Auth::id())->first()->class;
        $teacher_id = DB::table('subjects')->where('id', Auth::id())->first()->teacher_id;
        $subjects = DB::table('subtables')->where('teacher_id', $teacher_id)->get();
    @endphp

    <div class="py-12">

        @if ($class != null)
            <h1 class="text-2xl font-bold text-center mt-6">Class Teacher Tools</h1>
            <div class="max-w-7xl grid gap-x-8 md:grid-cols-3 mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-green-700 flex my-4 mx-8 justify-between px-10 py-10 overflow-hidden shadow-sm sm:rounded-lg hover:scale-110 transition duration-300 ease-in-out">
                    <div class="text-sm text-white w-1/2">
                        View Students
                        <p class="text-xs italic">View student in class</p>
                    </div>
                    <a href=""
                        class="bg-transparent h-12 w-28 hover:bg-white text-white font-semibold hover:text-green-700 py-2 px-4 border border-white hover:border-transparent rounded">
                        Click here
                    </a>
                </div>

                <div
                    class="bg-green-700 flex my-4 mx-8 justify-between px-10 py-10 overflow-hidden shadow-sm sm:rounded-lg hover:scale-110 transition duration-300 ease-in-out">
                    <div class="text-sm text-white w-1/2">
                        Upload Results
                        <p class="text-xs italic">Upload results for students in class.</p>
                    </div>
                    <a href=""
                        class="bg-transparent h-12 w-28 hover:bg-white text-white font-semibold hover:text-green-700 py-2 px-4 border border-white hover:border-transparent rounded">
                        Click here
                    </a>
                </div>

                <div
                    class="bg-green-700 flex my-4 mx-8 justify-between px-10 py-10 overflow-hidden shadow-sm sm:rounded-lg hover:scale-110 transition duration-300 ease-in-out">
                    <div class="text-sm text-white w-1/2">
                        Add Comments
                        <p class="text-xs italic">Add Comments to results</p>
                    </div>
                    <a href=""
                        class="bg-transparent h-12 w-28 hover:bg-white text-white font-semibold hover:text-green-700 py-2 px-4 border border-white hover:border-transparent rounded">
                        Click here
                    </a>
                </div>
            </div>
        @endif

        @if ($subjects->first() != null)
            <h1 class="text-2xl font-bold text-center mt-6">Subject Teacher Tools</h1>

            <div class="max-w-7xl grid gap-x-8 md:grid-cols-3 mx-auto sm:px-6 lg:px-8">

                <div
                    class="bg-green-700 flex my-4 mx-8 justify-between px-10 py-10 overflow-hidden shadow-sm sm:rounded-lg hover:scale-110 transition duration-300 ease-in-out">
                    <div class="text-sm text-white w-1/2">
                        View Students
                        <p class="text-xs italic">View student in class</p>
                    </div>
                    <a href=""
                        class="bg-transparent h-12 w-28 hover:bg-white text-white font-semibold hover:text-green-700 py-2 px-4 border border-white hover:border-transparent rounded">
                        Click here
                    </a>
                </div>

                <div
                    class="bg-green-700 flex my-4 mx-8 justify-between px-10 py-10 overflow-hidden shadow-sm sm:rounded-lg hover:scale-110 transition duration-300 ease-in-out">
                    <div class="text-sm text-white w-1/2">
                        Upload Results
                        <p class="text-xs italic">Upload results for students in class.</p>
                    </div>
                    <a href="{{ route('upload-index') }}"
                        class="bg-transparent h-12 w-28 hover:bg-white text-white font-semibold hover:text-green-700 py-2 px-4 border border-white hover:border-transparent rounded">
                        Click here
                    </a>
                </div>

                <div
                    class="bg-green-700 flex my-4 mx-8 justify-between px-10 py-10 overflow-hidden shadow-sm sm:rounded-lg hover:scale-110 transition duration-300 ease-in-out">
                    <div class="text-sm text-white w-1/2">
                        Add Comments
                        <p class="text-xs italic">Add Comments to results</p>
                    </div>
                    <a href=""
                        class="bg-transparent h-12 w-28 hover:bg-white text-white font-semibold hover:text-green-700 py-2 px-4 border border-white hover:border-transparent rounded">
                        Click here
                    </a>
                </div>
            </div>
        @endif

        @if (strpos($teacher_id, 'ADMIN') !== false)
            <h1 class="text-2xl font-bold text-center mt-6">Admin Tools</h1>

            <div class="max-w-7xl grid gap-x-8 md:grid-cols-3 mx-auto sm:px-6 lg:px-8">

                <div
                    class="bg-green-700 flex my-4 mx-8 justify-between px-10 py-10 overflow-hidden shadow-sm sm:rounded-lg hover:scale-110 transition duration-300 ease-in-out">
                    <div class="text-sm text-white w-1/2">
                        View Results
                        <p class="text-xs italic">View Results and Analysis</p>
                    </div>
                    <a href=""
                        class="bg-transparent h-12 w-28 hover:bg-white text-white font-semibold hover:text-green-700 py-2 px-4 border border-white hover:border-transparent rounded">
                        Click here
                    </a>
                </div>

                <div
                    class="bg-green-700 flex my-4 mx-8 justify-between px-10 py-10 overflow-hidden shadow-sm sm:rounded-lg hover:scale-110 transition duration-300 ease-in-out">
                    <div class="text-sm text-white w-1/2">
                        View Teachers
                        <p class="text-xs italic">View Teachers in class</p>
                    </div>
                    <a href="{{ route('admin-teacher') }}"
                        class="bg-transparent h-12 w-28 hover:bg-white text-white font-semibold hover:text-green-700 py-2 px-4 border border-white hover:border-transparent rounded">
                        Click here
                    </a>
                </div>

                <div
                    class="bg-green-700 flex my-4 mx-8 justify-between px-10 py-10 overflow-hidden shadow-sm sm:rounded-lg hover:scale-110 transition duration-300 ease-in-out">
                    <div class="text-sm text-white w-1/2">
                        Students
                        <p class="text-xs italic">View Students in class</p>
                    </div>
                    <a href="{{ route('admin-student') }}"
                        class="bg-transparent h-12 w-28 hover:bg-white text-white font-semibold hover:text-green-700 py-2 px-4 border border-white hover:border-transparent rounded">
                        Click here
                    </a>
                </div>

                <div
                    class="bg-green-700 flex my-4 mx-8 justify-between px-10 py-10 overflow-hidden shadow-sm sm:rounded-lg hover:scale-110 transition duration-300 ease-in-out">
                    <div class="text-sm text-white w-1/2">
                        Approve Results
                        <p class="text-xs italic">Approve uploaded results for students.</p>
                    </div>
                    <a href=""
                        class="bg-transparent h-12 w-28 hover:bg-white text-white font-semibold hover:text-green-700 py-2 px-4 border border-white hover:border-transparent rounded">
                        Click here
                    </a>
                </div>

                <div
                    class="bg-green-700 flex my-4 mx-8 justify-between px-10 py-10 overflow-hidden shadow-sm sm:rounded-lg hover:scale-110 transition duration-300 ease-in-out">
                    <div class="text-sm text-white w-1/2">
                        Allocate Subjects
                        <p class="text-xs italic">Allocate Teachers to Subjects</p>
                    </div>
                    <a href=""
                        class="bg-transparent h-12 w-28 hover:bg-white text-white font-semibold hover:text-green-700 py-2 px-4 border border-white hover:border-transparent rounded">
                        Click here
                    </a>
                </div>
            </div>
        @endif

    </div>
</x-app-layout>
