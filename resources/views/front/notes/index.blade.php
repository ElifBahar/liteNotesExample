@extends('front.layouts.master')





@section('content')



    <button class="btn btn-success">Not Oluştur</button>


    <br>


    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    BU SAYFADA NOTLAR LİSTELENECEK



@endsection
