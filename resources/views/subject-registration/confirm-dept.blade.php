<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subject Registration') }}
        </h2>
    </x-slot>

    <h1 class="mt-24 text-center text-lg font-semibold">Confirm Department</h1>

    <form class="flex w-full justify-center" method="POST" action="{{ route('confirm-department-form') }}">
        @csrf
        <div class="flex lg:w-1/2 w-full items-center border-b border-green-500 py-2 px-2">
            <input name="dept" value="{{$dept->dept}}" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="" aria-label="Department" disabled>
            <button class="flex-shrink-0 bg-green-500 hover:bg-green-700 border-green-500 hover:border-green-700 text-sm border-4 text-white py-1 px-2 rounded" type="submit">
              Confirm
            </button>
            <button class="flex-shrink-0 border-transparent border-4 text-green-500 hover:text-green-800 text-sm py-1 px-2 rounded" type="button">
              Make Complaint
            </button>
        </div>
    </form>

</x-app-layout>