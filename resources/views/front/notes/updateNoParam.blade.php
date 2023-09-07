@extends('front.layouts.master')

@section('content')

    <h1>Burası Güncelleme Sayfası (URL PARAMETRESİZ)</h1>




    @if( $errors->any() )


        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)

                    <li>  {{$error}}</li>


                @endforeach

            </ul>
        </div>

    @endif

    <form action="{{route('notes_editNoteNoParameter')}}" method="POST">
        @csrf

        <input type="hidden" name="not_id" value="{{$not->id}}">


        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Başlık</label>
            <input type="text" name="title" value="{{$not->title}}"  placeholder="Lütfen başlık giriniz" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            <!-- name -> key ,  değer ->value -->
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">İçerik</label>
            <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$not->content}}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Gönder</button>


    </form>




@endsection
