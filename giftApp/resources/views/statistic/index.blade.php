@extends('statistic.layout')

@section('content')

<div class="jumbotron container">
  
  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
  <a class="btn btn-primary btn-lg" href="{{route('prostatistics.create')}}" role="button">Create</a>
</div>

<div class="container">
      @if ($message = Session::get('success'))
      <div class="alert alert-primary" role="alert">
        {{$message}}
        </div>
      @endif

    

  </div>


<div class="container">
<table class="table table-dark">
  <thead>
    <tr>
    

    <th scope="col">id </th>

      <th scope="col">user_id </th>
      <th scope="col"> gift_id </th>
      <th scope="col">total_amount </th>
      <th scope="col">bank_transaction_id </th>
      
    </tr>
  </thead>
  <tbody>

  @php
   $i = 0;
  @endphp

  @foreach($statistic as $statistic)
    <tr>
      <th scope="row">{{++$i}}</th>

      <td>{{ $statistic->user_id }}</td>
      <td>{{ $statistic->gift_id}}</td>
      <td> {{ $statistic-> total_amount}} </td>
      <td> {{ $statistic-> bank_transaction_id}} </td>

      
      
      
      <td>
      <div class="row">
    <div class="col-sm">
    <a class="btn btn-success" href="{{ route('dashboard.edit',$statistic->id)}}">Edit</a>
    </div>
    <div class="col-sm">
    <a class="btn btn-primary" href=" {{ route('dashboard.show',$statistic->id)}}">Show</a>
    </div>
    <div class="col-sm">
    <form action="{{ route('dashboard.destroy',$statistic->id)}}">
      
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">Delete</button>
      </form>

    </div>
  </div>


      
     

      
      
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $statistic->links() }}

</div>

@endsection