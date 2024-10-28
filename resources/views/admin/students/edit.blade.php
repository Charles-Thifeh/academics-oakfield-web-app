<x-app-layout>
    <style>
        input[type="radio"]:checked + span {
            display: block;
        }
    </style>

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('View Student / Edit') }}
            </h2>
        </x-slot>

        <div class="container mx-auto">
            <div class="p-5 mx-auto my-10 bg-white rounded-md shadow-sm">
                <div class="flex justify-between px-10">
                    <div class="flex w-full justify-start">
                        <a href="{{ route('admin-student') }}">
                            <button class="px-4 py-4 text-white bg-red-500 rounded-md  hover:bg-red-600 hover:outline-none">
                                <- Back
                            </button>
                        </a>
                    </div>

                    <div class="flex w-full justify-end">
                        <button class="px-4 py-4 text-white bg-green-500 rounded-md  hover:bg-green-600 hover:outline-none" id="open-btn">

                        </button>
                    </div>

                </div>



            </div>

            <div class="max-w-xl p-5 mx-auto my-10 bg-white rounded-md shadow-sm">
                <div class="text-center">
                  <h1 class="my-3 text-3xl font-semibold text-gray-700">{{ 'Add Teacher' }}</h1>
                  <p class="text-gray-400">Fill in the correct details</p>
                </div>
                <div>
                  <form class="mt-8" action="{{route('admin-student-update')}}" method="POST">
                      @csrf
                      <input type="hidden" name="id" value="{{ $student->id }}">
                      <div class="mb-6">
                          <label class="inline-block text-sm text-gray-600" for="color">Surname</label>
                          <div class="relative flex w-full">
                              <input name="surname" type="text" class="block w-full py-3 pl-4 pr-8 bg-white border border-gray-300 rounded-sm appearance-none cursor-pointer focus:outline-none hover:border-gray-400" placeholder="Surname" value="{{ $student->surname }}">

                          </div>
                      </div>

                      <div class="mb-6">
                        <label class="inline-block text-sm text-gray-600" for="color">Firstname</label>
                        <div class="relative flex w-full">
                            <input name="firstname" type="text" class="block w-full py-3 pl-4 pr-8 bg-white border border-gray-300 rounded-sm appearance-none cursor-pointer focus:outline-none hover:border-gray-400" placeholder="Firstname" value="{{ $student->firstname }}">

                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="inline-block text-sm text-gray-600" for="color">Registration Number</label>
                        <div class="relative flex w-full">
                            <input name="reg_no" type="text" class="block w-full py-3 pl-4 pr-8 bg-white border border-gray-300 rounded-sm appearance-none cursor-pointer focus:outline-none hover:border-gray-400" placeholder="Registration Number" value="{{ $student->reg_no }}">

                        </div>
                    </div>

                      <div class="mb-6">
                          <label class="inline-block text-sm text-gray-600" for="color">Assign Class</label>
                          <div class="relative flex w-full">
                              <select name="class" class="block w-full py-3 pl-4 pr-8 bg-white border border-gray-300 rounded-sm appearance-none cursor-pointer focus:outline-none hover:border-gray-400">
                                  <option selected>{{ $student->class }}</option>
                                  <option disabled> Select new class </option>
                                  <option disabled> Senior Secondary School </option>
                                  <option>SSS 3</option>
                                  <option>SSS 2</option>
                                  <option>SSS 1</option>
                                  <br>
                                  <option disabled> Junior Secondary School </option>
                                  <option>JSS 3</option>
                                  <option>JSS 2</option>
                                  <option>JSS 1</option>
                                  <br>
                                  <option disabled> Primary School </option>
                                  <option>PRIMARY 6</option>
                                  <option>PRIMARY 5</option>
                                  <option>PRIMARY 4</option>
                                  <option>PRIMARY 3</option>
                                  <option>PRIMARY 2</option>
                                  <option>PRIMARY 1</option>
                                  <br>
                                  <option disabled> Pre-School </option>
                                  <option>NURSERY 2</option>
                                  <option>NURSERY 1</option>
                                  <option>KG 2</option>
                                  <option>KG 1</option>
                                  <option>RECEPTION</option>
                              </select>
                              <div class="absolute inset-y-0 right-0 flex items-center px-2 text-green-400 pointer-events-none">
                              <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                  <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
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
                                <option>{{ $student->dept }}</option>
                                <option disabled>Select Department</option>
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


