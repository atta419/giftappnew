@extends('statistic.layout')

@section('content')

<div class="container"   style="padding-top: 12%">
    <div class="card ">

        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
</div>


<div class="container" style="padding-top: 2%">
<form action="{{ route('prostatistics.store')}}" method="POST">
    @csrf

   

    <div class="form-group">
          <label for="exampleFormControlInput1"> user_id </label>
          <input type="text" name="user_id " class="form-control"  placeholder=" gift_id  ">
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput1">gift_id </label>
          <input type="text" name="gift_id " class="form-control"  placeholder="gift_id ">
        </div>
         
        <div class="form-group">
          <label for="exampleFormControlInput1"> total_amount </label>
          
          <input type="text" name=" total_amount " class="form-control"  placeholder="  total_amount">
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput1"> bank_transaction_id </label>
          
          <input type="text" name=" bank_transaction_id " class="form-control"  placeholder=" bank_transaction_id ">
        </div>

    

         

          


         

        

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>

        </div>



    </form>
</div>





@endsection