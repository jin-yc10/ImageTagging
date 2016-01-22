{{--
 Created by jin-yc10 on 15/10/22.
 --}}


@extends("Layout")
@section("title")
    Login
@endsection
@section("head")
@endsection
@section("body")
    @include('tag.head')
    <div class="container" style="margin-top: 60px">
        <ol class="breadcrumb">
            <li><a href="/dashboard">Dashboard</a></li>
            <li>Dataset</li>
        </ol>
        {{-- message part --}}
        @if(Session::has('message'))
            <p> {{ Session::get('message') }} </p>
        @endif
        <table class="table table-striped">
            <caption class="bigger">数据集</caption>
            <thead>
            <tr>
                <th>序号</th>
                <th>名称</th>
                <th>描述</th>
            </tr>
            </thead>
            <tbody>
            @foreach($datasets as $d)
                <tr>
                    <td>{{$d->id}}</td>
                    <td><a href="/tag/{{$d->id}}">{{$d->name}}</a></td>
                    <td>{{$d->description}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section("after-body")
@endsection