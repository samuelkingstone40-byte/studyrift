@extends('layouts.default')
<title>Buy-Studymerit</title>
@section('content')
  <div class="container mt-10">
    <span  id="loader" class="circlespinner"></span>
    <div>
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div>
      @endif
    </div>
    <h3 class=" text-4xl font-bold my-2">Billing</h3>
    <div>
      <table id="cart" class="table border-collapse border bg-white">
          <thead>
                <tr>
                  <th class="border" style="width:70%">Document Name</th>
                  <th class="border" style="width:20%" class="text-center">Qty</th>
                  <th class="border" style="width:5%" class="text-center">Price</th>
                  <th class="border" style="width:5%">Remove</th>
                </tr>
          </thead>
          <tbody>
                @php $total = 0 @endphp
                @if(session('cart'))
                  @foreach(session('cart') as $id => $details)
                    @php $total += $details['price'] * $details['quantity'] @endphp
                    <tr data-id="{{$id}}" id="{{ $id }}" class="doc">
                      <td data-th="Product" class="border">
                        <div class="row">
                            
                            <div class="col-sm-12">
                              <p class="nomargin">{{ Str::limit($details['name'],60) }}</p>
                            </div>
                        </div>
                      </td>
                        
                      <td data-th="Quantity" class="border text-center">
                        <input type="number" disabled value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />
                      </td>
                      <td data-th="Subtotal"  class="text-center border">{{ $details['price'] * $details['quantity'] }}</td>
                      <td class="actions border" data-th="">
                        <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i></button>
                      </td>
                    </tr>
                  @endforeach
                @endif
          </tbody>
          <tfooter>
            <tr>
                    <td colspan="2"></td>
                    <td class="text-xl" ><strong>Total<strong> </td>
                    <td  class="text-xl" >
                    {{ number_format($total,2) }}
                    <input type="hidden" name="" class="" id="total" value="{{$total}}">
                    </td>
            </tr>
          </tfooter>
      </table>
    </div>

    <div class="bg-white py-3 px-2">
      <div class="text-xl font-bold my-2 text-red-500">Select Mode Of Payment</div>
      <form class="" action="{{url('make-payment')}}" method="post">
        @csrf
        <div class="grid grid-cols-2 gap-4">
          <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
            <input checked id="bordered-radio-2" type="radio" value="pesapal" name="payment_mode" class="w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="bordered-radio-2" class="w-full py-4 ml-2 text-md font-medium text-gray-900 dark:text-gray-300">Pay With PesaPal</label>
         </div>
          <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
            <input id="bordered-radio-1" type="radio" value="seerbit" name="payment_mode" class="w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="bordered-radio-1" class="w-full py-4 ml-2 text-md font-medium text-gray-900 dark:text-gray-300">Pay With SeerBit</label>
        </div>
        </div>

     
          <input type="hidden" required name="amount" id="total_amount">
          <input type="hidden" name="docs[]" id="docs">
    
          <button class="h-12 text-bold text-lg btn bg-green-600 text-white " type="submit">Make Payment</button>
      

      </form>

    </div>
  </div>


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
