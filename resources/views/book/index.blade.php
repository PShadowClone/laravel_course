@extends('base_layout._layout')
@section('style')
    <style>
        .fa-book, .fa-search {
            margin-right: 5px;
        }
    </style>
@endsection
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-search"></i>Search</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="GET">
                                <div class="col-sm-4 form-group">
                                    <label for="Title">Title</label>
                                    <input type="text" name="title" class="form-control"
                                           value="{{app('request')->get('title')}}">
                                </div>
                                <div class=" col-sm-4 form-group">
                                    <label for="author">Author</label>
                                    <input type="text" name="author" class="form-control"
                                           value="{{app('request')->get('author')}}">
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="isbn">Isbn</label>
                                    <input type="text" name="isbn" class="form-control"
                                           value="{{app('request')->get('isbn')}}">
                                </div>
                                <div class="col-sm-12 form-action text-right">
                                    <input type="submit" class="btn btn-primary" value="{{trans('lang.search')}}">
                                    <a href="{{route('book.index')}}" class="btn btn-default">
                                        Cancel
                                    </a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-book"></i>Books</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Isbn</th>
                            <th>Publish Date</th>
                            <th style="text-align: center">Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td>{{$book->title}}</td>
                                <td>{{$book->author}}</td>
                                <td>{{$book->isbn}}</td>
                                <td>{{$book->getPublishDate()}}</td>
                                <td style="text-align: center">
                                    <a href="{{route('book.edit',['id' => $book->id])}}" class="btn btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="btn btn-danger remove-book"
                                       title="Remove"
                                       data-value="{{$book->id}}"
                                       data-title="{{$book->title}}"
                                            {{--href="{{route('book.destroy',['id' => $book->id])}}"--}}
                                    >
                                        <i class="fa fa-trash"></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="col-md-12 text-right">
                        {{$books->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var removeFunction = function () {

        }
        $('a.remove-book').click(function () {
            var id = $(this).data('value')
            var title = $(this).data('title')
            swal({
                    title: "Are you sure?",
                    text: "Do you want to remove " + title + " book ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                },
                function () {
                    window.location = "{{route('book.destroy')}}/" + id
                });

        })

    </script>
@endsection