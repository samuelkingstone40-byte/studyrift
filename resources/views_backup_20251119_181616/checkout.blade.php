@extends('layouts.default')
<title>Cart Checkout - Studymerit</title>
@section('content')
  <section class=" bg-gray-50 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 ">
    <div class="py-8">
      @if($errors->any())
       <div class="alert alert-danger alert-dismissible bg-danger text-black border-0 fade show"
                    role="alert">
        {{ implode('', $errors->all('<div>:message</div>')) }}
       </div>
      @endif
        <div class="mx-auto py-16 px-4">
            <h1 class="text-2xl py-2 font-semibold">Shopping Cart</h1>
            <div class="flex flex-col md:flex-row gap-4">
                <div class="w-full">
                    <div class="bg-white rounded-lg border  p-6 mb-4">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="text-left font-semibold px-6 py-4 ml-2">Product</th>
                                    <th class="text-left font-semibold px-6 py-4 ml-2">Price</th>
                                    <th class="text-left font-semibold px-6 py-4 ml-2">Remove</th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody >
                              @php $total = 0 @endphp
                              @if(session('cart'))
                                @foreach(session('cart') as $id => $details)
                                  @php $total += $details['price'] * $details['quantity'] @endphp
                                  <tr data-id="{{$id}}" id="{{ $id }}" class="doc bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <img class="w-10 h-10 md:h-24 md:w-24 mr-4" src="{{route('get-s3-thumbnail',$id)}}" alt="Product image">
                                            <span class="font-semibold text-sm md:text-lg line-clamp-2">{{$details['name']}}</span>
                                        </div>
                                    </td>
                                  
                                    <td class="px-6 py-4">${{$details['price']}}</td>
                                    <td class="actions border" data-th="">
                                      <button class="p-2  remove-from-cart">
                                        <svg class="w-6 h-6 text-red-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                                        </svg>
                                      </button>
                                    </td>
                                </tr>
                              
                                @endforeach
                                @endif

                                <tfoot>
                                  <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                
                                    <td class="px-6 py-4 text-lg md:xl font-semibold" colspan="1">Total</td>
                                    <td class="px-6 py-4 text-lg md:xl font-semibold">
                                      ${{$total}}
                                      <input type="hidden" name="" class="" id="total" value="{{$total}}">
                                    </td>
                                  </tr>
                                </tfoot>

                                
                                <!-- More product rows -->
                            </tbody>
                        </table>
                    </div>
                </div>
              
            </div>
            <div class="bg-white py-3 px-4 rounded mt-10 border border-gray-200 dark:border-gray-700">
              <div class="text-xl font-bold my-2 text-red-500">Select Mode Of Payment</div>
              <form class="" action="{{url('make-payment')}}" method="post">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                  <div class="flex col-span-2 lg:col-span-1 items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                    <input checked id="bordered-radio-2" type="radio" value="pesapal" name="payment_mode" class="w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="bordered-radio-2" class="w-full py-4 ml-2 text-md font-medium text-gray-900 dark:text-gray-300">Pay With PesaPal</label>
                </div>
{{--                    <div class="flex col-span-2 lg:col-span-1 items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                    <input id="bordered-radio-1"  type="radio" value="intasend" name="payment_mode" class="w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="bordered-radio-1" class="w-full py-4 ml-2 text-md font-medium text-gray-900 dark:text-gray-300">Pay With Intasend</label>
                </div> --}}
                </div>
        
            
                  <input type="hidden" required name="amount" id="total_amount">
                  <input type="hidden" name="docs[]" id="docs">
            
                  <button class="h-12 mt-4  text-bold text-lg btn bg-green-600 text-white rounded px-4" type="submit">Make Payment</button>
              
        
              </form>

             
        
            </div>
        </div>
    </div>
  </section>
 
@endsection
@section('scripts')

<script type="text/javascript">
  $(document).ready(function(){
    $('#loader').hide();
    var total_amt=$('#total').val();
    $('#total_amount').val(total_amt);
    var docs=myOrders();
    console.log(docs)
    $('#docs').val(docs);

    function myOrders() {
      var items=document.getElementsByClassName("doc")
      let orders = []
      for(var i = 0, c = items.length; i<c; i++) {
       orders.push(items[i].id);
      }
      return orders
    }
    $(".update-cart").change(function (e) {
        e.preventDefault();
        $('#loader').show();
        var ele = $(this);

        $.ajax({
            url: "{{ route('update.cart') }}",
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents("tr").attr("data-id"),
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });

    $(".remove-from-cart").click(function (e) {
        e.preventDefault();

        var ele = $(this);

        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: "{{ route('remove.from.cart') }}",
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
});


</script>
@endsection
