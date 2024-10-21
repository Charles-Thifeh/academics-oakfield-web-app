@php
    $surname = DB::table("students")->where("id", Auth::id())->first()->surname;
    $firstname = DB::table("students")->where("id", Auth::id())->first()->firstname;
    $fullname = $surname." ".$firstname;
    $reg_no = DB::table("students")->where("id", Auth::id())->first()->reg_no;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paystack Payment</title>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container mx-auto">
        <div class="max-w-xl p-5 mx-auto my-10 bg-white rounded-md shadow-sm">
          <div class="text-center">
            <h1 class="my-3 text-3xl font-semibold text-gray-700">Pay with Paystack</h1>
            <p class="text-gray-400">Fill up the form below</p>
          </div>
          <div>
            <form id="paymentForm">
              <div class="mb-6">
                <label for="name" class="block mb-2 text-sm text-gray-600"
                  >Full Name</label
                >
                <input
                  type="text"
                  name="name"
                  value="{{ $fullname }}"
                  disabled
                  class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md  focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300"
                />
              </div>
              <div class="mb-6">
                <label for="email" class="block mb-2 text-sm text-gray-600"
                  >Registration Number</label
                >
                <input
                  type="text"
                  name="reg_no"
                  value="{{ $reg_no }}"
                  disabled
                  class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md  focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300"
                />
              </div>
              <div class="mb-6">
                <label for="phone" class="text-sm text-gray-600">Payable Amount</label>
                <input
                  type="text"
                  name="payable"
                  value="{{ $payment->payableamount - $payment->amountpaid }}"
                  disabled
                  class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md  focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300"
                />
              </div>
              <div class="mb-6">
                <label for="phone" class="text-sm text-gray-600">Amount to be Paid</label>
                <input
                  type="text"
                  id="amount"
                  name="amount"
                  value=""
                  max="{{ $payment->payableamount }}"
                  required
                  class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md  focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300"
                />
              </div>
              <div class="mb-6">
                <button
                  type="submit"
                  onclick="payWithPaystack()"
                  class="w-full px-2 py-4 text-white bg-indigo-500 rounded-md  focus:bg-indigo-600 focus:outline-none"
                >
                  Pay with Paystack
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>


      <script src="https://js.paystack.co/v1/inline.js"></script>
      <script>
          const paymentForm = document.getElementById('paymentForm');
          paymentForm.addEventListener("submit", payWithPaystack, false);

          function payWithPaystack(e) {
              e.preventDefault();
              const amount = document.getElementById('amount').value;
              console.log(amount);
              if(amount <= {{ $payment->payableamount }}){
                let handler = PaystackPop.setup({
                    key: "{{ env('PAYSTACK_PUBLIC_KEY') }}",
                    email: "tictechsoft@gmail.com",
                    amount: amount*100,
                    metadata: {
                        custom_fields: [
                            {
                                display_name: "School Fees",
                                variable_name: "type",
                                value: "{{ $payment->id }}"
                            },
                            {
                                display_name: "Student",
                                variable_name: "name",
                                value: "{{ $fullname }}"
                            },
                            {
                                display_name: "Registration Number",
                                variable_name: "reg_no",
                                value: "{{ $reg_no }}"
                            }
                        ]
                    },
                    onClose: function(){
                        alert('Window closed.');
                    },
                    callback: function(response){
                        // let message = 'Payment complete! Reference: ' + response.reference;
                        // alert(message);
                        //alert(JSON.stringify(response))
                        window.location.href = "{{ route('callback') }}" + response.redirecturl;
                    }
                });
                handler.openIframe();
              }else{
                alert("Enter Value Less than the payable amount");
              }
          }
      </script>
</body>
</html>
