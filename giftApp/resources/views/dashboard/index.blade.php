@extends('dashboard.layout')

@section('content')

<div class="jumbotron container">
  
  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
  <a class="btn btn-primary btn-lg" href="{{route('dashboard.create')}}" role="button">Create</a>
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

      <th scope="col">total sales </th>
      <th scope="col">new users  </th>
      <th scope="col">total orders </th>
      
    </tr>
  </thead>
  <tbody>

  @php
   $i = 0;
  @endphp

  @foreach($dashboard as $dashboard)
    <tr>
      <th scope="row">{{++$i}}</th>

      <td>{{ $dashboard->total_sales }}</td>
      <td>{{ $dashboard->new_users}}</td>
      <td> {{ $dashboard-> total_orders}} </td>
      
      
      
      <td>
      <div class="row">
    <div class="col-sm">
    <a class="btn btn-success" href="{{ route('dashboard.edit',$dashboard->id)}}">Edit</a>
    </div>
    <div class="col-sm">
    <a class="btn btn-primary" href=" {{ route('dashboard.show',$dashboard->id)}}">Show</a>
    </div>
    <div class="col-sm">
    <form action="{{ route('dashboard.destroy',$dashboard->id)}}">
      
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

{{ $dashboard->links() }}

</div>

@endsection