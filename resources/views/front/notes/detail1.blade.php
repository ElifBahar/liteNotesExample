@extends('front.layouts.master')


@section('content')


        <div class="d-flex justify-content-between align-items-center">
            <h1> Burası Detay 1 sayfası</h1>

            <a class="btn btn-danger" href="{{route('notes_update',$not->id)}}"> Güncelle </a>
        </div>




        <br>

        <div class="bg-white p-3 rounded-3">
            <h2>{{$not->title}}</h2>
            <hr>

            <p>{{$not->content}}</p>

            <span class="text-muted"> {{$not->updated_at->diffForHumans()}} </span>

        </div>




@endsection
