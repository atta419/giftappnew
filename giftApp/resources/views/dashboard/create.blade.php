@extends('dashboard.layout')

@section('content')

<div class="container"   style="padding-top: 12%">
    <div class="card ">

        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
</div>


<div class="container" style="padding-top: 2%">
<form action="{{ route('dashboard.store')}}" method="POST">
    @csrf

    <div class="form-group">
          <label for="exampleFormControlInput1"> total_sales </label>
          <input type="text" name="total_sales " class="form-control"  placeholder=" total_sales  ">
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput1">new_users </label>
          <input type="text" name=" new_users" class="form-control"  placeholder=" new_users">
        </div>
         
        <div class="form-group">
          <label for="exampleFormControlInput1"> total_orders </label>
          
          <input type="text" name=" total_orders " class="form-control"  placeholder="  total_orders">
        </div>

    

         

          


         

        

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>

        </div>



    </form>
</div>





@endsection