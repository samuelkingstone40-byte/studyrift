@extends('layouts.app')
@section('content')
<div class="section_gap">
    <div class="container py-4">
        <div class="card" style="background:transparent">
       
            <div class="card-body">
                <h3 class="font-bold py-2">My Order</h3>
          
       <table id="cart" class="table table-hover table-condensed">
         <thead>
         <tr>
            <th style="width:5%">ID</th>
            <th style="width:50%">Document</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:17%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
         </tr>
         </thead>
        <tbody>
        @php $total = 0 @endphp
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)
                @php $total += $details['price'] * $details['quantity'] @endphp
                <tr data-id="{{ $id }}" class="doc">
                <td data-th="">{{ $id }}</td>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs">
                                
                        <img class="img-thumbnail" src="{{$details['image']}}" alt="">
                            </div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ Str::limit($details['name'],60) }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">${{ $details['price'] }}</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />
                    </td>
                    <td data-th="Subtotal"  class="text-center">{{ $details['price'] * $details['quantity'] }}</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4"></td>
            <td ><h3><strong>Total<h3><strong> </td>
            <td  class="text-right h3 font-bold" id="total">{{ $total }}</td>
        </tr>
        <tr>
            <td  colspan="5">
            <a href="{{ url('browse-files') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>

            </td>
            <td>
              
                    <div id="paypal-button-container" style="width:300px"></div>
                    
                </div>
              
            </td>
        </tr>
    </tfoot>
</table>
      
</div>
        </div>
</div>
</div>
@endsection
@section('scripts')
<script src="https://www.paypal.com/sdk/js?client-id=AVQZaJNGJXrEqXf_0TS_3VnG51Sgdc6s5K11YMkkVfaSqvlYw-2XC1XabNWJhlNa0stWsgU-rC7NFyrl&currency=USD"></script>

<script type="text/javascript">
   $(document).ready(function(){

  

    $(".update-cart").change(function (e) {
        e.preventDefault();
   
        var ele = $(this);
   
        $.ajax({
            url: '{{ route('update.cart') }}',
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
                url: '{{ route('remove.from.cart') }}',
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

   
 

function myOrders() {
    var orders=[];
    $(".doc td:nth-child(1)").each(function() {
        orders.push($(this).text());
      
    })
    return orders;
}

paypal.Buttons({
    createOrder: function(data, actions) {
      // This function sets up the details of the transaction, including the amount and line item details.
      return actions.order.create({
        application_context: {
          brand_name : 'Laravel Book Store Demo Paypal App',
          user_action : 'PAY_NOW',
        },
        purchase_units: [{
          amount: {
            value: $('#total').html()
          }
        }],
      });
    },
    

    onApprove: function(data, actions) {
      
      let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      let orders=myOrders();

      // This function captures the funds from the transaction.
      return actions.order.capture().then(function(details) {
          if(details.status == 'COMPLETED'){
            return fetch('/paypal-capture-payment', {
                      method: 'post',
                      headers: {
                          'content-type': 'application/json',
                          "Accept": "application/json, text-plain, */*",
                          "X-Requested-With": "XMLHttpRequest",
                          "X-CSRF-TOKEN": token
                      },
                      body: JSON.stringify({
                          orders:details.purchase_units,
                          orderId     : data.orderID,
                          id : details.id,
                          status: details.status,
                          payerEmail: details.payer.email_address,
                          docs:orders
                      })
                  })
                  .then(status)
                  .then(function(response){
                      //console.log(response)
                      // redirect to the completed page if paid
                     window.location.href = '/pay-success';
                  })
                  .catch(function(error) {
                      console.log(error)
                      // redirect to failed page if internal error occurs
                      window.location.href = '/pay-failed?reason=internalFailure';
                  });
          }else{
              window.location.href = '/pay-failed?reason=failedToCapture';
          }
      });
    },

    onCancel: function (data) {
        window.location.href = '/pay-failed?reason=userCancelled';
    }



    }).render('#paypal-button-container');
    // This function displays Smart Payment Buttons on your web page.

    function status(res) {
      if (!res.ok) {
          throw new Error(res.statusText);
      }
      return res;
    }
   
});
</script>
@endsection