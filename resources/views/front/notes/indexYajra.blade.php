@extends('front.layouts.master')

@section('style')

@endsection

@section('content')
    <h1>YAJRA LİSTE BURADA GÖZÜKECEK</h1>

    <div class="content">

        <table id="notesList" class="table table-responsive table-striped" style="width: 100%!important;">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>TITLE</th>
                    <th>DETAIL</th>
                    <th>DELETE</th>
                </tr>
            </thead>

            <tbody>

            </tbody>

            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>TITLE</th>
                    <th>DETAIL</th>
                    <th>DELETE</th>

                </tr>
            </tfoot>
        </table>

    </div>

@endsection

@section('script')


    <script type="text/javascript">

        //JQuery
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                }
            });


        });

        var dataTable = null;


        dataTable = $('#notesList').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Turkish.json'
            },
            order: [
                [0, 'ASC']
            ],
            processing: true,
            serverSide: true,
            scrollX: true,
            scrollY: true,
            ajax: '{!! route('fetchNotes') !!}',
            columns: [
                {data: 'id'},
                {data: 'title'},
                {data: 'detail'},
                {data: 'delete'},

            ]
        });



        function ddd(id){
            $.ajax({
                type: 'POST',
                headers: {'X-CSRF-TOKEN': "{{csrf_token()}} "},
                url: '{!! route('deleteNoteAjax') !!}',
                data: {
                    id: id
                },
                dataType: "json",

                success: function (response) {
                    console.log(response)
                    Swal.fire({
                        icon: "success",
                        title: "Başarılı",
                        html: response.success,
                        showConfirmButton: true,
                        confirmButtonText: "Tamam"
                    });
                    dataTable.ajax.reload();
                },

                error: function () {
                    Swal.fire({
                        icon: "error",
                        title: "Hata!",
                        html: "Silme Başarısız",
                        showConfirmButton: true,
                        confirmButtonText: "Tamam"
                    });
                }
            });
        }


    </script>





@endsection
