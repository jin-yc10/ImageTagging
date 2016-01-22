{{--
 Created by jin-yc10 on 15/10/22.
 --}}
@extends('layouts.master')
@section('title', '数据标注平台｜没有更多')
@section('tag', 'active')
@section("content")
    <div class="container" style="margin-top: 50px">
        <div class="breadcrumbs" style="margin-bottom: 0px; padding-top:15px;padding-bottom:15px;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-sm-4">
                        <h2 style="margin-top:10px;">{{$dataset->name}}</h2>
                    </div>
                    <div class="col-lg-8 col-sm-8">
                        <ol class="breadcrumb pull-right" style="margin-top:13px;">
                            <li><a href="/dashboard">Dashboard</a></li>
                            <li>{{$dataset->name}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        @if(Session::has('message'))
            <div class="alert alert-warning">
                <a href="#" class="close" data-dismiss="alert">
                    &times;
                </a>
                <strong>警告！</strong>
                <p> {{ Session::get('message') }} </p>
            </div>
        @endif
        <div class="text-center feature-head">
            <h1><strong>惊人的成就,没有更多的数据可以被标注了!</strong></h1>
            <p>试试选择其他数据集或者持续关注我们的网站</p>
        </div>
    </div>
@endsection
