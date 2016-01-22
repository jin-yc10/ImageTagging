{{--
 Created by jin-yc10 on 15/10/22.
 --}}
@extends("Layout")
@section("head")
@endsection
@section("body")
 @include('user.Logout')
 @if(Session::has('message'))
     <p> {{ Session::get('message') }} </p>
 @endif
 <?php $standardItems = $dataset->StandardItems; ?>
 @foreach($standardItems as $s)
  <div>
      {{$s->id}} &nbsp; {{$s->name}}
  <form action="/back/dataset/{{$s->id}}" method="POST">
   <input type="hidden" name="_method" value="DELETE">
   {!! csrf_field() !!}
   <input type="submit" value="删除">
  </form>
  </div>
 @endforeach
@endsection
@section("after-body")
@endsection