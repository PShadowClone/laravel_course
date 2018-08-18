@extends('base_layout._layout')
@section('body')
    <div class="row">

        <form action="{{route('book.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group " style="text-align: center">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                         style="width: 200px; height: 150px;"></div>
                    <div>
                                                            <span class="btn red btn-outline btn-file">
                                                                <span class="fileinput-new"> Select image </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                <input type="file" name="book_image"> </span>
                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">
                            Remove </a>
                        <span class="error">{{$errors->first('book_image')}}</span>

                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="title">Title <span class="required">*</span></label>
                <input type="text" class="form-control" name="title" value="{{old('title')}}">
                <span class="error">{{$errors->first('title')}}</span>
            </div>
            <div class="form-group">
                <label for="writer">Writer <span class="required">*</span></label>
                <input type="text" class="form-control" name="writer">
                <span class="error">{{$errors->first('writer')}}</span>

            </div>
            <div class="form-group">
                <label for="author">Author <span class="required">*</span></label>
                <input type="text" class="form-control" name="author">
                <span class="error">{{$errors->first('author')}}</span>

            </div>
            <div class="form-group">
                <label for="publisher">publisher <span class="required">*</span></label>
                <input type="text" class="form-control" name="publisher">
                <span class="error">{{$errors->first('publisher')}}</span>

            </div>
            <div class="form-group">
                <label for="isbn">Isbn <span class="required">*</span></label>
                <input type="text" class="form-control" name="isbn">
                <span class="error">{{$errors->first('isbn')}}</span>

            </div>
            <div class="form-group">
                <label for="publish_date">Publish Date <span class="required">*</span></label>
                <input type="text" class="form-control" name="publish_time">
                <span class="error">{{$errors->first('publish_time')}}</span>

            </div>

            <div class="form-action">
                <input type="submit" class="btn btn-primary" value="Store">
                <input type="reset" class="btn btn-default" value="cancel">
            </div>

        </form>
    </div>
@endsection