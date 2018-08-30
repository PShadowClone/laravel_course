@extends('base_layout._layout')
@section('breadcrumb')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{route('category.index')}}">@lang('category.titles.categories')</a>
                <i class="fa fa-circle"></i>
            </li>

        </ul>
    </div>
@endsection
@section('body')
    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-search"></i>@lang('lang.search')</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{route('category.index')}}" method="GET">
                                <div class="col-sm-6 form-group">
                                    <label for="name">@lang('category.fields.name')</label>
                                    <input type="text" name="title" class="form-control"
                                           value="{{app('request')->get('title')}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="lang">@lang('category.fields.language')</label>
                                    <select name="lang" id="lang" class="form-control">
                                        <option value="-1">@lang('lang.choose_language')</option>
                                        <option value="ar" {{app('request')->has('ar') ? 'selected' : ''}}>@lang('lang.arabic')</option>
                                        <option value="en" {{app('request')->has('en') ? 'selected' : ''}}>@lang('lang.english')</option>
                                    </select>
                                </div>
                                <div class="form-action col-sm-12 text-right">
                                    <input type="submit" value="{{trans('lang.search')}}" class="btn btn-primary">
                                    <a class="btn btn-default"
                                       href="{{route('category.index')}}">@lang('lang.cancel')</a>
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
                    <h3 class="panel-title"><i class="fa fa-book"></i>@lang('category.titles.categories')</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                        <tr>
                            <th class="text-center">@lang('category.fields.name')</th>
                            <th class="text-center">@lang('category.fields.language')</th>
                            <th style="text-align: center" class="text-center">@lang('lang.options')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td class="text-center">{{$category->name}}</td>
                                <td class="text-center">{{$category->getLang()}}</td>
                                <td class="text-center">
                                    <a href="{{route('category.edit',['id' => $category->id])}}" class="btn btn-primary ">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="btn btn-danger delete-category"
                                       data-value="{{$category->id}}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="com-md-12 text-right">
                        {{$categories->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.delete-category').click(function () {
            var id = $(this).data('value')
            swal({
                    title: "@lang('lang.questions.confirm_remove')",
                    text: "@lang('category.questions.do_remove')",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "@lang('lang.yes')",
                    cancelButtonText: "@lang('lang.no')",
                    closeOnConfirm: false
                },
                function () {

                    /**
                     *
                     * send ajax request for deleting category
                     *
                     */
                    $.ajax({
                        url: '{{route('category.destroy')}}/' + id,
                        method: 'GET',
                        data: {body: '', _token: '{{csrf_token()}}'}
                    }).success(function (response) {
                        if (response.status == 200) {
                            swal("@lang('lang.alert')", response.message, "success")
                            window.location.reload()
                        } else {
                            swal("@lang('lang.alert')", response.message, "error")
                        }
                    })

                });

        })

    </script>
@endsection