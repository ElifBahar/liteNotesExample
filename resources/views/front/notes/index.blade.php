@extends('front.layouts.master')





@section('content')

    <a class="btn btn-success" href="{{ route('notes_createPage') }}"> Not Oluştur</a>


    <br>


    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    BU SAYFADA NOTLAR LİSTELENECEK



@endsection
