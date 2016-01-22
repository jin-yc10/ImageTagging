{{--
 Created by jin-yc10 on 15/10/22.
 --}}
@extends('layouts.master')
@section('title', '数据标注平台｜首页')
@section('tag', 'active')
@section("content")
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
                        <li>{{$standard->name}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center feature-head">
        <h1>您搞定了一个分类!<strong>赞</strong></h1>
        <p><a href="/tag/{{$dataset->id}}">继续标注</a></p>
    </div>
@endsection
