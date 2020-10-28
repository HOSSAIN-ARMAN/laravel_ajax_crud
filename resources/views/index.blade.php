@extends('welcome')


@section('body')

    <h2 style="margin-top: 12px;" class="alert alert-success">Ajax CRUD with Laravel App -
        <a href="https://www.codingdriver.com" target="_blank" >CodingDriver</a>
    </h2><br>
    <div class="row">
        <div class="col-12 text-right">
            <a href="javascript:void(0)" class="btn btn-outline-info mb-3 py-3" id="create-new-post" onclick="addPost()">Add Post</a>
            <a href="javascript:void(0)" class="btn btn-outline-dark mb-3 py-0" id="show-post-data" onclick="showPost()">Display Post</a>
        </div>
    </div>

    <div class="row padding">
        <div class="col-md-6">
{{--            laravel--}}
            <label for="exampleFormControlSelect1">Show Entries BY Laravel</label>
            <select id="apports" type="dropdown-toggle" class="form-control" name="apports" onchange="top.location.href = this.options[this.selectedIndex].value">
                    <option value="{{ route('posts.showByLaravel', ['i' => 100]) }}" class="btn-outline-light">All</option>
                    @foreach($posts as  $key=>$post)
                        <option class="apports"
                                value="{{ route('posts.showByLaravel', ['i' => $key+1]) }}"
                                id="selectValue"
                            {{ \App\Post::paginate($key+1) ? 'selected' : 'All'}}
                        >{{$key + 1}}</option>
                    @endforeach
            </select>
            <hr>

{{--            //jquery--}}
            <label for="exampleFormControlSelect1">Show Entries</label>
            <select id="data_dropdown" onchange="showTableRow(this)">
                <option value="1">One</option>
                <option value="2" selected>Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <div class="col-md-6">
{{--            laravel--}}
            <form id="laravelSearch" class="form" action="{{ route('posts.search') }}" method="POST">
                @csrf
                <input type="text" class="form-control" placeholder="Laravel Search" name="search_data" id="search_data" aria-label="search" aria-describedby="search">
                <button type="submit" id="search_btn_text" class="btn btn-outline-info" >Laravel Search</button>
            </form>
            <hr>

{{--            jquery--}}

            <label for="search">Search</label>
            <input type="text" id="myInput" class="form-control" placeholder="Search now" aria-label="search" aria-describedby="search">
        </div>
    </div>


    <div class="row" style="clear: both;margin-top: 18px;">
        <div class="col-12">
            <table id="laravel_crud" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $key=>$post)
                    <tr id="row_{{$post->id}}" class="tr">
                        <td>{{ $key++  }}</td>
                        <td>{{ $post->title ? $post->title : 'none'  }}</td>
                        <td>{{ $post->description }}</td>
                        <td><a href="javascript:void(0)" data-id="{{ $post->id }}" onclick="editPost(event.target)" class="btn btn-info">Edit</a></td>
                        <td>
                            <a href="javascript:void(0)" data-id="{{ $post->id }}" class="btn btn-danger" onclick="deletePost(event.target)">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="row padding">
                <div class="col-md-9"></div>
                <div class="col-md-3">{{ $posts->links() }}</div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="post-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form name="userForm" class="form-horizontal">
                        <div class="form-group">
                            <label for="name" class="col-sm-2">title</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
                                <span id="titleError" class="alert-message"></span>
                                <input type="hidden" name="id" id="post_id" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2">Description</label>
                            <div class="col-sm-12">
                        <textarea class="form-control" id="description" name="description" placeholder="Enter description" rows="4" cols="50">
                        </textarea>
                                <span id="descriptionError" class="alert-message"></span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn_text" class="btn btn-primary" onclick="createPost()">Save</button>
                    <button type="button" id="btn_text" class="btn btn-danger" onclick="cancelModal()">Cancel</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>

        // --------for searching ----------------
        $(document).ready(function () {
            $('#myInput').on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $('.tr').filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });

        // ---------------ajax crud---------------

        $("#laravel_crud").DataTable();

        function showTableRow(select) {
            // alert(select.options[select.selectedIndex].text);
            var total = select.options[select.selectedIndex].value;
            $.ajax({
                url: '{{ route('posts.display') }}'+'/'+total,
                type : 'GET',
                success: function (response) {
                    if (response) {
                        $('table tbody').empty();
                        $.each(response.data, function (key, value) {
                            $('table tbody').prepend('<tr id="row_'+value.id+'"> ' +
                                '<td>'+ key++ + '</td>'+
                                '<td>' +value.title+ '</td>' +
                                '<td>' +value.description+ '</td>'+
                                '<td> <a href="javascript:void(0)" data-id = "'+ value.id +'" onclick = "editPost(event.target)" class="btn btn-outline-info" > Edit </a>'+
                                '<td> <a href="javascript:void(0)" data-id = "' + value.id+'" onclick="deletePost(event.target)" class="btn btn-outline-danger">Delete </a>' +
                                '</tr>')
                        });
                    }

                }
            });

        }

        function emptyData () {
            $("#post_id").val("");
            $("#title").val("");
            $("#description").val("");
            $('#btn_text').html('save');
        }

        function addPost() {
            emptyData();
            $("#post-modal").modal('show');
        }
        function cancelModal () {
            emptyData();
            $("#post-modal").modal('hide');
        }

        function editPost (event) {

            var id = $(event).data("id");
            if (id) {
                $('#btn_text').html('update');
            }
            $.ajax({
                url  : '{{ URL::route('posts.edit') }}/'+id,
                type : 'GET',
                success:function (response) {
                    if(response) {
                        $("#post_id").val(response.id);
                        $("#title").val(response.title);
                        $("#description").val(response.description);
                        $('#post-modal').modal('show');

                    }
                }
            });
        }

        function createPost() {
            var id = $("#post_id").val();
            var title = $('#title').val();
            var description = $('#description').val();
            var url     = "{{ route('posts.store') }}";
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    id : id,
                    title: title,
                    description: description,
                    _token:'{{ csrf_token() }}',
                },
                success: function(response) {
                    if (response){
                     Swal.fire(response.message);
                     if ( id) {
                         $("#row_"+id+" td:nth-child(2)").html(response.data.title);
                         $("#row_"+id+" td:nth-child(3)").html(response.data.description);
                     }else {
                         $('table tbody').prepend('<tr id="row_'+response.data.id+'"> ' +
                             '<td>'+ response.data.id + '</td>'+
                             '<td>' +response.data.title+ '</td>' +
                             '<td>' +response.data.description+ '</td>'+
                             '<td> <a href="javascript:void(0)" data-id = "'+ response.data.id +'" onclick = "editPost(event.target)" class="btn btn-info" > Edit </a>'+
                             '<td> <a href="javascript:void(0)" data-id = "' + response.data.id +'" onclick="deletePost(event.target)" class="btn btn-danger">Delete </a>' +
                             '</tr>')
                        }
                    };

                    emptyData();
                    $("#post-modal").modal('hide');

                },
                error: function(response) {
                    $('#titleError').text(response.responseJSON.errors.title);
                    $('#descriptionError').text(response.responseJSON.errors.description);
                }
            });
        }

        function deletePost(event) {
            var id = $(event).data("id");
            $.ajax({
                url    : '{{ route('posts.delete') }}',
                type   : 'POST',
                data   : {
                   id    : id,
                  _token : '{{ csrf_token() }}',
                },
                success: function (response) {
                    $("#row_"+id).remove();
                    if (response.code == 200 ) {
                        Swal.fire('delete  successfully');
                    }
                },
                error    : function (response) {
                    $('#titleError').text(response.responseJSON.errors.title);
                    $('#descriptionError').text(response.responseJSON.errors.description);
                }
            });
        }

        // ------------you can show if you want ---------------
        function showPost() {
            $.ajax({
                url: '{{ route('posts.show') }}',
                type : 'GET',
                success: function (response) {
                    if (response) {
                        $('table tbody').empty();
                        $.each(response.data, function (key, value) {
                            $('table tbody').prepend('<tr id="row_'+value.id+'"> ' +
                                '<td>'+ key++ + '</td>'+
                                '<td>' +value.title+ '</td>' +
                                '<td>' +value.description+ '</td>'+
                                '<td> <a href="javascript:void(0)" data-id = "'+ value.id +'" onclick = "editPost(event.target)" class="btn btn-outline-info" > Edit </a>'+
                                '<td> <a href="javascript:void(0)" data-id = "' + value.id+'" onclick="deletePost(event.target)" class="btn btn-outline-danger">Delete </a>' +
                                '</tr>')
                        });
                    }

                }
            });
        }

    </script>

@endpush
