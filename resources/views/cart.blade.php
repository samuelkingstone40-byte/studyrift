@extends('layouts.app')
@section('content')

<span  id="loader" class="circlespinner"></span>
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
            <a href="{{ url('search') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>

            </td>
            <td>
             <h5 class="text-warning">Select payment option</h5>
            @guest
            <a href="{{route('login')}}" class="genric-btn info radius  btn-block">Login </a>

            @else
            <button type="button" style="background:#04091e" class="btn  btn-block btn-lg text-white" id="ravepay" ><img  width="30" src="{{asset('theme/img/rave.png')}}" class="mr-2"> Pay with flutterwave</button>
            <div id="paypal-button-container" style="width:300px"></div>
            @endguest
                    
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
<script src="https://www.paypal.com/sdk/js?client-id=AZR8hLRpmE4st9mF0yAH7uLs8OwAh8vuUKNu1sGCkvr_95Sr_m34NFKxGK0IlUw_8SfafXw7IKcF4_1u&currency=USD"></script>
<script src="https://checkout.flutterwave.com/v3.js"></script>

<script type="text/javascript">
   $(document).ready(function(){
     $('#loader').hide();
     $(".update-cart").change(function (e) {
        e.preventDefault();
        $('#loader').show();
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
          brand_name : 'Study Merit',
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
                      console.log(response)
                      // redirect to the completed page if paid
                     window.location.href = '/pay-success';
                  })
                  .catch(function(error) {
                      console.log(error)
                      // redirect to failed page if internal error occurs
                      //window.location.href = '/pay-failed?reason=internalFailure';
                  });
          }else{
              alert('failed')
          }
      });
    },

    onCancel: function (data) {
        alert('failed')
    }



    }).render('#paypal-button-container');
    // This function displays Smart Payment Buttons on your web page.

    function status(res) {
      if (!res.ok) {
          throw new Error(res.statusText);
      }
      return res;
    }


    $('#ravepay').click(function(e) {
       e.preventDefault();
       let orders=myOrders();
       FlutterwaveCheckout({
       public_key: "FLWPUBK_TEST-c9d6287a35aee9e2cc16accad023e22b-X",
       tx_ref: "SM_{{substr(rand(0,time()),0,7)}}",
       amount: $('#total').html(),
       currency: "USD",
       payment_options: "card",
     
       
       customer: {
         email: "{{Auth::user()->email}}",
         name: "{{Auth::user()->name}}",
       },
       
       customizations: {
         title: "Study Merit",
         description: "Payment for an awesome cruise",
         logo: "https://studymerit.com/theme/img/logo2.png",
       },
       callback : function(data){
         var transid=data.transaction_id;
         var _token=$("input[name='_token']").val();
         $.ajax({
             type:'post',
             url:"{{route('verify-payment')}}",
             data:{
                 transid,
                 _token,
                 docs:orders
             },
             success:function(response){
                if(response=='success'){
                window.location.href = '/pay-success';
                }
             }
             
         })
       },
       onclose:function(){
             location.reload();
       },
      
     });
   
       
         })


});


</script>
@endsection