<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Academics | Oakfield Schools</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-green-600 selection:bg-red-500 selection:text-white">
            <nav
            class="top-0 absolute z-50 w-full flex flex-wrap items-center justify-between px-2 py-3 "
          >
            <div
              class="container px-4 mx-auto flex flex-wrap items-center justify-between"
            >
              <div
                class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start"
              >
                <a
                  class="text-3xl font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap text-white"
                  >Academics Portal</a
                ><button
                  class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"
                  type="button"
                  onclick="toggleNavbar('example-collapse-navbar')"
                >
                  <i class="text-white fas fa-bars"></i>
                </button>
              </div>
              <div
                class="lg:flex flex-grow items-center bg-white lg:bg-transparent lg:shadow-none hidden"
                id="example-collapse-navbar"
              >

              </div>
            </div>
          </nav>
          <main>
            <div
              class="relative pt-8 pb-8 flex items-center justify-center"
            >
              <div
                class="absolute top-0 w-full h-full bg-center bg-cover"
                {{-- style='background-image: url("https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1267&amp;q=80");' --}}
              >
                {{-- <span
                  id="blackOverlay"
                  class="w-full h-full absolute opacity-75 bg-black"
                ></span> --}}
              </div>
              <div class="container relative mx-auto">
                <div class="items-center flex flex-wrap">
                  <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
                    <div class="">
                      <h1 class="text-white font-semibold text-5xl">
                        Academics Portal by tic atelier
                      </h1>
                      {{-- {{ Hash::make("academics_admin") }} --}}
                      <p class="mt-4 text-lg text-gray-300">
                        Do you want manage your classes, teachers, upload results and analyse results? this is the best one for you.
                      </p>
                    </div>
                  </div>

                </div>
              </div>
            </div>
              <div class="w-full lg:w-6/12 ml-auto mr-auto text-center flex justify-center">
                  <div class="">
                      @auth
                          <a href="{{ url('/dashboard') }}">
                          <button class="bg-white hover:bg-green-800 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded-full">
                            Dashboard
                            </button>
                        </a>
                      @else
                          <a href="{{ route('login') }}">
                              <button class="bg-white hover:bg-green-800 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded-full">
                              Login
                              </button>
                          </a>
                      @endauth
                  </div>
              </div>
            </main>
        </div>
    </body>
</html>
