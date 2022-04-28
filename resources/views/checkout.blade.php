@extends('layouts.app')
@section('content')

<span  id="loader" class="circlespinner"></span>
<div class="section_gap ">
    <div class="container">
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3 mt-4">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-secondary badge-pill">{{count(session('cart'))}}</span>
          </h4>
          <ul class="list-group mb-3 mt-4">
            @php $total = 0 @endphp
            @if(session('cart'))
            @foreach(session('cart') as $id => $details)
            @php $total += $details['price'] * $details['quantity'] @endphp
            <li id="{{ $id }}"  class="list-group-item d-flex justify-content-between lh-condensed item">
              <div>
                <h6 class="my-0">Product name</h6>
                <small class="text-muted">{{$details['name']}}</small>
              </div>
              <span class="text-muted">${{ $details['price'] }}</span>
            </li>
            @endforeach
           
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (USD)</span>
              <strong>${{ $total }}</strong>
              <input type="hidden" id="total" value="{{$total}}">
            </li>
          </ul>
           @endif
        
        </div>
        <div class="col-md-8 order-md-1">
          <h3 class="mb-3 mt-4">Billing address</h3>
          <form class="needs-validation" novalidate>
              @csrf
            @guest
            <div class="row">
                
              <div class="col-md-6 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" id="cname" placeholder=""  required>
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control" id="lastName" placeholder=""  required>
                <div class="invalid-feedback">
                  Valid last name is required.
                </div>
              </div>
            </div>
    
           
    
            <div class="mb-3">
              <label for="email">Email</label>
              <input type="email" class="form-control"   id="cemail" placeholder="you@example.com">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>
            @else

            <div class="row">
                
                <div class="col-md-6 mb-3">
                  <label for="firstName">First name</label>
                  <input type="text" class="form-control" id="cname" placeholder="" value="{{Auth::user()->name}}" required>
                  <div class="invalid-feedback">
                    Valid first name is required.
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="lastName">Last name</label>
                  <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                  <div class="invalid-feedback">
                    Valid last name is required.
                  </div>
                </div>
              </div>
      
             
      
              <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" value="{{Auth::user()->email}}"   id="cemail" placeholder="you@example.com">
                <div class="invalid-feedback">
                  Please enter a valid email address for shipping updates.
                </div>
              </div>
            @endguest
    
            
    
        
           
            <hr class="mb-4">
    
            <h4 class="mb-3">Payment Option</h4>
    
            
            <div class="row">
               
                <div class="col-12">
               <form>
  <div>
    Your order is ₦54,600
  </div>
  <button type="button" id="ravepay" >Pay Now</button>
</form>
                </div>
               
            </div>
           
           
          </form>
        </div>
      </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://www.paypal.com/sdk/js?client-id=AYtW_ATgH0S2gv_oxT9HWy1DgnJB4FtZqYZ139foyxgp6_vLtuzbhLLAHhGqKGpds1BM0xjOdzA3qcT7&currency=USD"></script>
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

     var items=document.getElementsByClassName("item")
      , orders = []
      ; 
    for(var i = 0, c = items.length; i<c; i++) {
        orders.push(items[i].id);
      }

      return orders
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
            value: $('#total').val()
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
              alert('Cancled')
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

       var cname=$('#cname').val();
       var cemail=$('#cname').val();
       if (cname == null || cname == "", cemail == null || cemail== "") {
           alert('Name and email fields are required')
       }else{
       FlutterwaveCheckout({
       public_key: "FLWPUBK-68785a86d1281b5d9fae604b977cf150-X",
       tx_ref: "SM_{{substr(rand(0,time()),0,7)}}",
       amount: $('#total').val(),
       currency: "USD",
       payment_options: "card",
       
       
       
       customer: {
         email: $('#cemail').val(),
         name: $('#cname').val(),
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
    }
   
       
         })


});


</script>
@endsection