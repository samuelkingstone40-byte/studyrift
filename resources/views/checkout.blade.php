@extends('layouts.app')
@section('content')

<span  id="loader" class="circlespinner"></span>
<div class="section_gap ">
  <div class="container">
    <div class="row">
      <div class="col-md-7 order-md-1">
        <div class="card">
          <div class="card-body">
            <h3 class="mb-5 card-title">Your Billing address</h3>
            <form class="needs-validation" action="{{url('payment')}}" method="post">
              @csrf
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="firstName">First name</label>
                  <input type="text" name="fname" class="form-control" id="firstName" placeholder="" value="" required>
                  <div class="invalid-feedback">
                     Valid first name is required.
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="lastName">Last name</label>
                  <input type="text" name="lname" class="form-control" id="lastName" placeholder="" value="" required>
                  <div class="invalid-feedback">
                    Valid last name is required.
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <label for="email">Email <span class="text-muted"></span></label>
                <input type="email" name="email" class="form-control" id="email" required placeholder="you@example.com">
                <div class="invalid-feedback">
                  Please enter a valid email.
                </div>
              </div>

              <div class="mb-3">
                <label for="address">Phone (Optional) </label>
                <input type="text" name="phone" class="form-control" id="phone" placeholder="+1 XXX XXX" >
                <div class="invalid-feedback">
                  Please enter your address.
                </div>
              </div>

              <div class="mb-3">
                <label for="address2">Address <span class="text-muted"></span></label>
                <input type="text" name="address" class="form-control" id="address2" placeholder="Apartment or suite">
              </div>
              <input type="hidden" required name="amount" id="total_amount">
              <input type="text" name="docs[]" id="docs">
              <hr class="mb-4">
              <button class="btn btn-primary btn-lg btn-block" type="submit">Proceede to payment</button>
           </form>
          </div>
        </div>
      </div>
      
      <div class="col-md-5 order-md-1">
        <div class="card">
          <div class="card-body">
            <h4 class="mb-3 mt-4">Your cart</h4>
            <table id="cart" class="table  table-condensed">
              <thead>
                <tr>
                  <th style="width:70%">Document</th>
                  <th style="width:20%" class="text-center">Qty</th>
                  <th style="width:5%" class="text-center">Price</th>
                  <th style="width:5%">Remove</th>
                </tr>
              </thead>
              <tbody>
                @php $total = 0 @endphp
                @if(session('cart'))
                  @foreach(session('cart') as $id => $details)
                    @php $total += $details['price'] * $details['quantity'] @endphp
                    <tr data-id="{{$id}}" id="{{ $id }}" class="doc">
                      <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs">        
                              <img class="img-thumbnail" src="{{$details['image']}}" alt="">
                            </div>
                            <div class="col-sm-9">
                              <p class="nomargin">{{ Str::limit($details['name'],60) }}</p>
                            </div>
                        </div>
                      </td>
                        
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
              <tfooter>
                <tr>
                    <td colspan="2"></td>
                    <td ><h4><strong>Total<h4><strong> </td>
                    <td  class="" >
                    {{ number_format($total,2) }}
                    <input type="hidden" name="" id="total" value="{{$total}}">
                    </td>
                </tr>
              </tfooter>

            </table>
      

           <!-- <div id="smart-button-container">
      <div style="text-align: center;">
        <div id="paypal-button-container"></div>
      </div>
    </div>

    <div id="smart-button-container">
      <div style="text-align: center;">
         <div id="paypal-button-container"></div>
       </div>
    </div> -->
        </div>
      </div>
          


   

        </div>
        <!-- <div class="col-md-5 order-md-1">
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





            


 

              </div> -->

                <!-- <div class="col-12">
               <form>

  <button type="button" class="btn btn-warning btn-lg text-white" id="ravepay" >Pay With Flutterwave <img width="45px" src="{{asset('theme/img/rave.png')}}"/></button>
</form>
                </div> -->

            </div>


          </form>
        </div>
      </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://checkout.flutterwave.com/v3.js"></script>
<script src="https://www.paypal.com/sdk/js?client-id=AS7kIbBnwq1Hbq-xPoMHJJbmvKW0xu3hD6CcdAyvFryIpuyA_3oq_eqz3QvqO-FZvO3e5KfbZmlP52hQ&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>

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


  
    // function initPayPalButton() {
    //   paypal.Buttons({
    //     style: {
    //       shape: 'pill',
    //       color: 'gold',
    //       layout: 'vertical',
    //       label: 'pay',
          
    //     },

    //     createOrder: function(data, actions) {
    //       return actions.order.create({

    //         purchase_units: [{"amount":{"currency_code":"USD","value":$('#total').val()}}],
    //         application_context: {
    //        brand_name : 'Study Merit',
    //        user_action : 'PAY_NOW',
    //      },
    //       });
    //     },

    //     onApprove: function(data, actions) {
    //       let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    //   let orders=myOrders();

    //   // This function captures the funds from the transaction.
    //   return actions.order.capture().then(function(details) {

    //       if(details.status == 'COMPLETED'){
    //         return fetch('/paypal-capture-payment', {
    //                   method: 'post',
    //                   headers: {
    //                       'content-type': 'application/json',
    //                       "Accept": "application/json, text-plain, */*",
    //                       "X-Requested-With": "XMLHttpRequest",
    //                       "X-CSRF-TOKEN": token
    //                   },
    //                   body: JSON.stringify({
    //                       orders:details.purchase_units,
    //                       orderId : data.orderID,
    //                       id : details.id,
    //                       status: details.status,
    //                       payerEmail: details.payer.email_address,
    //                       docs:orders
    //                   })
    //               })
    //               .then(status)
    //               .then(function(response){
    //                   console.log(response)
    //                   // redirect to the completed page if paid
    //                  window.location.href = '/pay-success';
    //               })
    //               .catch(function(error) {
    //                   console.log(error)
    //                   // redirect to failed page if internal error occurs
    //                   //window.location.href = '/pay-failed?reason=internalFailure';
    //               });
    //       }else{
    //           alert('Cancled')
    //       }
    //   });
    //     },

    //     onError: function(err) {
    //       alert('Cancled')
    //     }
    //   }).render('#paypal-button-container');
    // }
    //initPayPalButton();

    // paypal.Buttons({
    //  createOrder: function(data, actions) {
    //   // This function sets up the details of the transaction, including the amount and line item details.
    //   return actions.order.create({
    //     application_context: {
    //       brand_name : 'Study Merit',
    //       user_action : 'PAY_NOW',
    //     },
    //     purchase_units: [{
    //       amount: {
    //         value: $('#total').val()
    //       }
    //     }],
    //   });
    // },


    // onApprove: function(data, actions) {

    //   let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    //   let orders=myOrders();

    //   // This function captures the funds from the transaction.
    //   return actions.order.capture().then(function(details) {

    //       if(details.status == 'COMPLETED'){
    //         return fetch('/paypal-capture-payment', {
    //                   method: 'post',
    //                   headers: {
    //                       'content-type': 'application/json',
    //                       "Accept": "application/json, text-plain, */*",
    //                       "X-Requested-With": "XMLHttpRequest",
    //                       "X-CSRF-TOKEN": token
    //                   },
    //                   body: JSON.stringify({
    //                       orders:details.purchase_units,
    //                       orderId     : data.orderID,
    //                       id : details.id,
    //                       status: details.status,
    //                       payerEmail: details.payer.email_address,
    //                       docs:orders
    //                   })
    //               })
    //               .then(status)
    //               .then(function(response){
    //                   console.log(response)
    //                   // redirect to the completed page if paid
    //                  window.location.href = '/pay-success';
    //               })
    //               .catch(function(error) {
    //                   console.log(error)
    //                   // redirect to failed page if internal error occurs
    //                   //window.location.href = '/pay-failed?reason=internalFailure';
    //               });
    //       }else{
    //           alert('Cancled')
    //       }
    //   });
    // },

    // onCancel: function (data) {
    //     alert('failed')
    // }



    // }).render('#paypal-button-container');
    // This function displays Smart Payment Buttons on your web page.

    // function status(res) {
    //   if (!res.ok) {
    //       throw new Error(res.statusText);
    //   }
    //   return res;
    // }


    // $('#ravepay').click(function(e) {
    //    e.preventDefault();
    //    let orders=myOrders();

    //    var cname=$('#cname').val();
    //    var cemail=$('#cname').val();
    //    if (cname == null || cname == "", cemail == null || cemail== "") {
    //        alert('Name and email fields are required')
    //    }else{
    //    FlutterwaveCheckout({
    //    public_key: "FLWPUBK-68785a86d1281b5d9fae604b977cf150-X",
    //    tx_ref: "SM_{{substr(rand(0,time()),0,7)}}",
    //    amount: $('#total').val(),
    //    currency: "USD",
    //    payment_options: "card",



    //    customer: {
    //      email: $('#cemail').val(),
    //      name: $('#cname').val(),
    //    },

    //    customizations: {
    //      title: "Study Merit",
    //      description: "Payment for an awesome cruise",
    //      logo: "https://studymerit.com/theme/img/logo2.png",
    //    },
    //    callback : function(data){
    //      var transid=data.transaction_id;
    //      var _token=$("input[name='_token']").val();
    //      $.ajax({
    //          type:'post',
    //          url:"{{route('verify-payment')}}",
    //          data:{
    //              transid,
    //              _token,
    //              docs:orders
    //          },
    //          success:function(response){
    //             if(response=='success'){
    //             window.location.href = '/pay-success';
    //             }
    //          }

    //      })
    //    },
    //    onclose:function(){
    //          location.reload();
    //    },

    //  });
    // }


    //      })


});


</script>
@endsection
