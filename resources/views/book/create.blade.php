@extends('base_layout._layout')

@section('body')
    <div class="row">
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        <form action="{{route('book.create')}}" method="POST" enctype="multipart/form-data">
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
                        <span class="error col-md-12">{{$errors->first('book_image')}}</span>

                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="title">Title <span class="required">*</span></label>
                <input type="text" class="form-control" name="title" value="{{old('title')}}">
                <span class="error">{{$errors->first('title')}}</span>
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" class="form-control" name="author">
            </div>
            <div class="form-group">
                <label for="writer">Writer</label>
                <input type="text" class="form-control" name="writer">
            </div>
            <div class="form-group">
                <label for="publisher">Publisher</label>
                <input type="text" class="form-control" name="publisher">
            </div>
            <div class="form-group">
                <label for="isbn">Isbn</label>
                <input type="text" class="form-control" name="isbn">
            </div>
            <div class="form-group">
                <label for="publish_date">Publish Date</label>
                <input class="form-control form-control-inline input-medium date-picker" type="text" value=""
                       name="publish_date" id="publish_date" data-date-format="yyyy-mm-dd">
            </div>

            <div class="form-action">
                <input type="submit" name="store" value="Store" class="btn btn-primary">
                <input type="reset" name="cancel" value="Cancel" class="btn btn-default">
            </div>
        </form>
    </div>
@endsection