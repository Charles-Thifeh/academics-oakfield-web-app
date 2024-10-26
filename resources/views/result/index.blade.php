<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Results') }}
        </h2>
    </x-slot>

    <div class="container mx-auto">
        <div class="max-w-xl p-5 mx-auto my-10 bg-white rounded-md shadow-sm">
          <div class="text-center">
            <h1 class="my-3 text-3xl font-semibold text-gray-700">Upload Results</h1>
            <p class="text-gray-400">Select the right options</p>
          </div>
          <div>
            <form class="mt-8" action="{{route('upload-query')}}" method="POST">
@csrf
                <div class="mb-6">
                    <label class="inline-block text-sm text-gray-600" for="color">Select Session</label>
                    <div class="relative flex w-full">
                        <select name="session" class="block w-full py-3 pl-4 pr-8 bg-white border border-gray-300 rounded-sm appearance-none cursor-pointer focus:outline-none hover:border-gray-400">
                            <option disabled selected>Select Session</option>
                            @if ($session->first() != null)
                                @foreach ($session as $single)
                                    <option>{{ $single->session }}</option>
                                @endforeach
                            @endif
                            <option>2024/2025</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 text-green-400 pointer-events-none">
                        <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
                        </svg>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="inline-block text-sm text-gray-600" for="color">Select Term</label>
                    <div class="relative flex w-full">
                        <select name="term" class="block w-full py-3 pl-4 pr-8 bg-white border border-gray-300 rounded-sm appearance-none cursor-pointer focus:outline-none hover:border-gray-400">
                            <option disabled selected>Select Term</option>
                            <option>First</option>
                            <option>Second</option>
                            <option>Third</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 text-green-400 pointer-events-none">
                        <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
                        </svg>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="inline-block text-sm text-gray-600" for="color">Select Examination Type</label>
                    <div class="relative flex w-full">
                        <select name="type" class="block w-full py-3 pl-4 pr-8 bg-white border border-gray-300 rounded-sm appearance-none cursor-pointer focus:outline-none hover:border-gray-400">
                            <option disabled selected>Select Type</option>
                            <option value="midterm">Mid Term Examination</option>
                            <option value="finalexam">Final Examination</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 text-green-400 pointer-events-none">
                        <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
                        </svg>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="inline-block text-sm text-gray-600" for="color">Select Subject</label>
                    <div class="relative flex w-full">
                        <select name="subject" class="block w-full py-3 pl-4 pr-8 bg-white border border-gray-300 rounded-sm appearance-none cursor-pointer focus:outline-none hover:border-gray-400">
                            <option disabled selected>Select Subject</option>
                            @foreach ($subjects as $item)
                                <option value="{{ $item->id }}">{{ $item->subject }} [{{ $item->level }}]</option>

                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 text-green-400 pointer-events-none">
                        <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
                        </svg>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="inline-block text-sm text-gray-600" for="color">Select Class</label>
                    <div class="relative flex w-full">
                        <select name="class" class="block w-full py-3 pl-4 pr-8 bg-white border border-gray-300 rounded-sm appearance-none cursor-pointer focus:outline-none hover:border-gray-400">
                            <option disabled selected>Select Class</option>
                            @foreach ($class as $item)
                                <option value="{{ $item }}">{{ $item }}</option>

                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 text-green-400 pointer-events-none">
                        <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
                        </svg>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <button
                    type="submit"
                    class="w-full px-2 py-4 text-white bg-green-500 rounded-md  focus:bg-green-600 focus:outline-none"
                    >
                    Next
                    </button>
                </div>
            </form>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="h-32 w-full bg-red-300 text-black py-8 px-2">{{$error}}</div>
                @endforeach
            @endif
          </div>
        </div>
      </div>
</x-app-layout>
