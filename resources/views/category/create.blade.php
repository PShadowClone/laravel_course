@extends('base_layout._layout')
@section('style')
    @if(app()->getLocale() == 'ar')
        <style>
            .fa-plus {
                margin-left: 5px;
            }
        </style>
    @else
        <style>
            .fa-plus {
                margin-right: 5px;
            }
        </style>
    @endif
@endsection
@section('breadcrumb')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{route('category.index')}}">@lang('category.titles.categories')</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>@lang('lang.add')</span>
            </li>
        </ul>
    </div>
@endsection
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading"><i class="fa fa-plus"></i>@lang('category.titles.add_category')</div>
                <div class="panel-body">
                    <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group " style="text-align: center">
                            <div class="fileinput fileinput-new col-md-12" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                     style="width: 200px; height: 150px;"></div>
                                <div>
                                                                <span class="btn red btn-outline btn-file">
                                                                    <span class="fileinput-new"> @lang('lang.select_image') </span>
                                                                    <span class="fileinput-exists"> @lang('lang.change') </span>
                                                                    <input type="file" name="category_image"> </span>
                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">
                                        @lang('lang.remove') </a>

                                </div>
                            </div>
                            <span class="error text-center">{{$errors->first('category_image')}}</span>

                        </div>
                        <div class="form-group">
                            <label for="title">@lang('category.fields.name') <span class="required">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}">
                            <span class="error">{{$errors->first('name')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="author">@lang('category.fields.language') <span
                                        class="required">*</span></label>
                            <select name="lang" id="lang" class="form-control">
                                <option value="-1">@lang('lang.choose_language')</option>
                                <option value="ar">@lang('lang.arabic')</option>
                                <option value="en">@lang('lang.english')</option>
                            </select>
                            <span class="error">{{$errors->first('lang')}}</span>

                        </div>
                        <div class="form-action text-center">
                            <input type="submit" name="store" value="@lang('lang.store')" class="btn btn-primary">
                            <a href="{{route('category.index')}}" type="reset" name="cancel"
                               class="btn btn-default">@lang('lang.cancel')</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection