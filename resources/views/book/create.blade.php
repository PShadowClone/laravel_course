@extends('base_layout._layout')

@section('body')
    <div class="row">
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        <form action="{{route('book.create')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title <span class="required">*</span></label>
                <input type="text" class="form-control" name="title">
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
                <input type="text" class="form-control" name="publish_date">
            </div>

            <div class="form-action">
                <input type="submit" name="store" value="Store" class="btn btn-primary">
                <input type="reset" name="cancel" value="Cancel" class="btn btn-default">
            </div>
        </form>
    </div>
@endsection