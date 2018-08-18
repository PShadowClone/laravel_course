@extends('base_layout._layout')
@section('style')
    <style>
        .fa-book {
            margin-right: 5px;
        }
    </style>
@endsection
@section('body')
    <div class="row">
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
                                    <a class="btn btn-danger" title="Remove"
                                       href="{{route('book.destroy',['id' => $book->id])}}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection