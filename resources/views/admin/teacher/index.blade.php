<x-app-layout>
<style>
    input[type="radio"]:checked + span {
        display: block;
    }
</style>
    <!---Modal -->
    <div class="fixed hidden insert-0 bg-opacity-50 overflow-y-auto h-screen w-screen top-2 z-10" id="modal">
        <div class="relative top-20 mx-auto px-5 border lg:w-1/2 w-full shadow-lg rounded-md bg-white">
            <div class="text-left">
                <div class="max-w-xl p-5 mx-auto my-10 bg-white rounded-md shadow-sm">
                    <div class="text-center">
                      <h1 class="my-3 text-xl font-semibold text-gray-700">Add Teacher</h1>
                      <p class="text-gray-400">Enter the Teacher Details</p>
                    </div>
                    <div>
                        <!-- Component Start -->
                        <form class="mt-4" action="{{route('make-payment-options')}}" method="GET">
                            <input type="text" name="bill_id" value="" hidden>
                            <input type="text" name="reg" value="" hidden>
                            <input type="number" name="payable" value="" hidden>
                            <fieldset>
                                <div class="grid grid-cols-2 gap-2 w-full max-w-screen-sm mb-6">
                                    <label for="paystack" class="relative flex flex-col bg-white p-5 rounded-lg shadow-md cursor-pointer">
                                        <span class="font-semibold text-gray-500 leading-tight uppercase mb-3">Paystack</span>
                                        <span class="text-md font-bold mt-2">Via the paystack online platform</span>
                                        <ul class="text-sm mt-2">
                                            <li>Very Secure</li>
                                            <li>Quick Verification</li>
                                        </ul>
                                        <input type="radio" name="paymenttype" id="paystack" value="paystack" class="hidden" />
                                        <span aria-hidden="true" class="hidden absolute inset-0 border-2 border-green-500 bg-green-200 bg-opacity-10 rounded-lg">
                                        <span class="absolute top-4 right-4 h-6 w-6 inline-flex items-center justify-center rounded-full bg-green-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5 text-green-600">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                        </span>
                                    </label>

                                    <label for="banktransfer" class="relative flex flex-col bg-white p-5 rounded-lg shadow-md cursor-pointer">
                                        <span class="font-semibold text-gray-500 leading-tight uppercase mb-3">Bank Transfer</span>
                                        <span class="text-md font-bold mt-2">Via Bank transfer from all Nigerian Banks</span>
                                        <ul class="text-sm mt-2">
                                            <li>Very Secure</li>
                                            <li>Verification within 1-3 business days</li>
                                        </ul>
                                        <input type="radio" name="paymenttype" id="banktransfer" value="banktransfer" class="hidden" />
                                        <span aria-hidden="true" class="hidden absolute inset-0 border-2 border-green-500 bg-green-200 bg-opacity-10 rounded-lg">
                                        <span class="absolute top-4 right-4 h-6 w-6 inline-flex items-center justify-center rounded-full bg-green-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5 text-green-600">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                        </span>
                                    </label>
                                </div>
                            </fieldset>
                            <div class="mb-6">
                                <button
                                  type="submit"
                                  class="w-full px-2 py-4 text-white bg-green-500 rounded-md  focus:bg-green-600 focus:outline-none"
                                >
                                  Make Payment
                                </button>
                            </div>
                        </form>
                        <!-- Component End  -->
                        <div class="items-center mb-6">
                            <button id="ok-btn" class="px-2 py-4 bg-red-500 text-white
                                            text-base font-medium rounded-md w-full
                                            shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                                Close
                            </button>

                        </div>
                    </div>
                  </div>
            </div>

        </div>
    </div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Teachers') }}
        </h2>
    </x-slot>

    <div class="container mx-auto">
        <div class="p-5 mx-auto my-10 bg-white rounded-md shadow-sm">
            <div class="flex justify-between px-10">
                <div class="flex w-full justify-start">
                    <a href="{{ route('go-back') }}">
                        <button class="px-4 py-4 text-white bg-red-500 rounded-md  hover:bg-red-600 hover:outline-none">
                            <- Back
                        </button>
                    </a>
                </div>

                <div class="flex w-full justify-end">
                    <button class="px-4 py-4 text-white bg-green-500 rounded-md  hover:bg-green-600 hover:outline-none" id="open-btn">
                        Add New Teacher
                    </button>
                </div>

            </div>


            {{-- Invoice starts --}}
            <div class="w-full mt-12 py-2 px-4 text-xl">
                    <div class="text-black text-center w-full my-2 py-2 px-4">
                        <h3 class="text-2xl font-extrabold">Teacher's List</h3>

                        <table class="w-full text-left border-collapse border border-slate-500">
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
                                    $subjects = DB::table('subtables')->select('subject', "level")
                                                                    ->where("teacher_id", $item->teacher_id)
                                                                    ->get();
                                @endphp
                                    <tr class="py-2 px-4">
                                        <td class="border border-slate-500">{{ $i = $i + 1 }}</td>
                                        <td class="border border-slate-500">
                                            {{ $item->surname }} {{ $item->firstname }}
                                            <p class="text-sm">
                                                {{ $item->phone }}
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
                                                    <a href="">
                                                        <button details="Edit details and class" class="text-xs h-8 px-4 text-white bg-blue-500 rounded-md  hover:bg-blue-600 hover:outline-none">
                                                            Edit
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="">
                                                    <a href="">
                                                        <button class="text-xs h-8 px-4 text-white bg-orange-500 rounded-md  hover:bg-orange-600 hover:outline-none">
                                                            Add
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="">
                                                    <button class="text-xs h-8 px-4 text-white bg-red-500 rounded-md  hover:bg-red-600 hover:outline-none">
                                                        Delete
                                                    </button>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>

            </div>
            {{-- Invoice ends --}}
        </div>


    </div>


    <script>
        let modal = document.getElementById('modal');
        let btn = document.getElementById('open-btn');
        let button = document.getElementById('ok-btn');

        btn.onclick = function () {
            modal.style.display = 'block';
        };

        button.onclick = function () {
            modal.style.display = 'none';
        };

        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

    </script>
</x-app-layout>


