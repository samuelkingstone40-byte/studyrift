@extends('layouts.admin')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-body">
                <h2 class="py-1">Account Balance</h2>
                <hr>
                <form action="" id="accountBalance" >
                    @csrf
                <div class="row">
                   
                    <div class="col-sm-4">
                        Start Date
                        <input type="date" id="start" name="start" class="form-control">
                    </div>
                    <div class="col-sm-4">
                         End Date
                        <input type="date" id="end" name="end" class="form-control">
                    </div>
                    <div class="form-group col-sm-4">
                        Action
                        <button class="form-control btn btn-success" type="button" id="btnfetch">Submit</button>
                    </div>
                    
                </div>
            </form>
                <hr>

                <div class="py-2">
                    <h3 style="font-weight:700;font-size:24px" class="justify-content-between d-flex"> Total Sales<span class="pull-right text-success" id="sales" ></span></h3>
                </div>
                <div class="py-2">
                    <h3 style="font-weight:700;font-size:24px" class="justify-content-between d-flex"> Total Withdrawals<span class="pull-right  text-success" id="withdrawals" ></span></h3>
                </div>
                <div class="py-2">
                    <h3 style="font-weight:700;font-size:24px" class="justify-content-between d-flex"> Total Income<span class="pull-right  text-success" id="income" ></span></h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
      fetch_bal();
     function fetch_bal(e){
       
        var formData = {
            start: new Date().toISOString(),
            end: new Date().toISOString(),
        };

       
        $.ajax({
            url: '{{ route('fetch-account-balance') }}',
            method: "get",
            data:formData,
            success: function (response) {
               console.log
               $('#sales').html(response.sales);
               $('#withdrawals').html(response.withdrawals);
               $('#income').html(response.income);
            }
        })
     }
     $("#btnfetch").click(function (e) {
         e.preventDefault();
         var formData = {
            start: $('#start').val(),
            end: $('#end').val(),
        };
        $.ajax({
            url: '{{ route('fetch-account-balance') }}',
            method: "get",
            data: formData,
            success: function (response) {
               $('#sales').html(response.sales);
               $('#withdrawals').html(response.withdrawals);
               $('#income').html(response.income);
            }
     })
    });
});
</script>
 @endsection