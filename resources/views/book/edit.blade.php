{{--{{dd($book->image)}}--}}
@extends('base_layout._layout')
@section('body')
    <div class="row">

        <form action="{{route('book.update',['id' => $book->id])}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group " style="text-align: center">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                         style="width: 200px; height: 150px;">
                        <img src="{{$book->getImage()}}" alt="">

                    </div>
                    <div>
                                                            <span class="btn red btn-outline btn-file">
                                                                <span class="fileinput-new"> Select image </span>
                                                                <span class="fileinput-exists"> Change </span>

                                                                <input type="file" name="book_image"> </span>
                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">
                            Remove </a>


                    </div>
                    <span class="error">{{$errors->first('book_image')}}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="title">Title <span class="required">*</span></label>
                <input type="text" class="form-control" name="title" value="{{$book->title}}">
                <span class="error">{{$errors->first('title')}}</span>
            </div>
            <div class="form-group">
                <label for="writer">Writer <span class="required">*</span></label>
                <input type="text" class="form-control" name="writer" value="{{$book->writer}}">
                <span class="error">{{$errors->first('writer')}}</span>

            </div>
            <div class="form-group">
                <label for="author">Author <span class="required">*</span></label>
                <input type="text" class="form-control" name="author" value="{{$book->author}}">
                <span class="error">{{$errors->first('author')}}</span>

            </div>
            <div class="form-group">
                <label for="publisher">publisher <span class="required">*</span></label>
                <input type="text" class="form-control" name="publisher" value="{{$book->publisher}}">
                <span class="error">{{$errors->first('publisher')}}</span>

            </div>
            <div class="form-group">
                <label for="isbn">Isbn <span class="required">*</span></label>
                <input type="text" class="form-control" name="isbn" value="{{$book->isbn}}">
                <span class="error">{{$errors->first('isbn')}}</span>

            </div>
            <div class="form-group">
                <label for="publish_date">Publish Date <span class="required">*</span></label>
                <input type="text" class="form-control" name="publish_time" value="{{$book->publish_time}}">
                <span class="error">{{$errors->first('publish_time')}}</span>

            </div>

            <div class="form-action text-center">
                <input type="submit" class="btn btn-primary" value="Edit">
                <a href="{{route('book.index')}}" class="btn btn-default">Cancel</a>
            </div>

        </form>
    </div>
@endsection