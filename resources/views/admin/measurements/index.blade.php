@extends('admin._layout.layout')

@section('seo_title', __('Measurements'))

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{__("Measurements")}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.index.index')}}">{{__("Index")}}</a></li>
                    <li class="breadcrumb-item active">{{__("Measurements")}}</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__("Sva merenja")}}</h3>
                        <div class="card-tools">
                            <form style="display: none;" id="change-priority-form" class="btn-group" method="post" action="{{route('admin.measurements.change_priorities')}}">
                                @csrf
                                <input type="hidden" name="priorities" value="">
                                <button type="submit" class="btn btn-outline-success">
                                    <i class="fas fa-check"></i>
                                    {{__("Sačuvaj redosled")}}
                                </button>
                                <button type="button" data-action='hide-form' class="btn btn-outline-danger">
                                    <i class="fas fa-remove"></i>
                                    {{__("Prekini")}}
                                </button>
                            </form>
                            <button data-action='show-form' class="btn btn-outline-secondary">
                                <i class="fas fa-sort"></i>
                                {{__("Izmeni redosled")}}
                            </button>
                            <a href="{{route('admin.measurements.add')}}" class="btn btn-success">
                                <i class="fas fa-plus-square"></i>
                                {{__("Kreiraj novo merenje")}}
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered" id="row-list-table">
                            <thead>
                                <tr>
                                    <th style="width: 2%">#</th>
                                    <th style="width: 10%;">{{__("Naziv")}}</th>
                                    <th style="width: 10%;">{{__("Gornji levi")}}</th>
                                    <th style="width: 10%;">{{__("Gornji desni")}}</th>
                                    <th style="width: 10%;">{{__("Donji levi")}}</th>
                                    <th style="width: 10%;">{{__("Donji desni")}}</th>
                                    <th class="text-center">{{__("Kreirano")}}</th>
                                    <th class="text-center">{{__("Vertikalni motor")}}</th>
                                    <th class="text-center">{{__("Horizontalni motor")}}</th>
                                    <th class="text-center">{{__("Akcije")}}</th>
                                </tr>
                            </thead>
                            <tbody id="sortable-list">
                                @foreach($measurements as $measurement)
                                <tr data-id="{{$measurement->id}}">
                                    <td>
                                        <span style="display: none;" class="btn btn-outline-secondary handle">
                                            <i class="fas fa-sort"></i>
                                        </span>
                                        #{{$measurement->id}}
                                    </td>
                                    <td>
                                        <strong class="text-success">{{$measurement->title}}</strong>
                                    </td>
                                    <td>
                                        {{$measurement->top_left_sensor}}
                                    </td>
                                    <td>
                                        {{$measurement->top_right_sensor}}
                                    </td>
                                    <td>
                                        {{$measurement->bottom_left_sensor}}
                                    </td>
                                    <td>
                                        {{$measurement->bottom_right_sensor}}
                                    </td>
                                    <td class="text-center">{{$measurement->datePresenter()}}</td>
                                    <td class="text-center">{{$measurement->vertical_engine % 1000}}</td>
                                    <td class="text-center">{{$measurement->horizontal_engine % 1000}}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{route('admin.measurements.edit', ['measurement' => $measurement->id])}}" class="btn btn-info">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#change-modal" data-action='change-status' data-id="{{$measurement->id}}" data-title="{{$measurement->title}}">
                                                @if($measurement->status == 0)
                                                <i class="fas fa-plus-circle"></i>
                                                @else
                                                <i class="fas fa-minus-circle"></i>
                                                @endif
                                            </button>
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#delete-modal" data-action='delete' data-id='{{$measurement->id}}' data-title='{{$measurement->title}}'>
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">

                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<form class="modal fade" id="delete-modal" action="{{route('admin.measurements.delete')}}" method="post">
    @csrf
    <input type="hidden" name="id" value="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{__("Obriši merenje")}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{__("Da li si siguran da želiš da obrišeš merenje?")}}</p>
                <strong data-container="title"></strong>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__("Prekini")}}</button>
                <button type="submit" class="btn btn-danger">{{__("Obriši")}}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</form>
<form action="{{route('admin.measurements.change_status')}}" method="post" class="modal fade" id="change-modal">
    @csrf
    <input type="hidden" name="id" value="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('Izmeni status')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>@lang('Da li si siguran da želiš da izmeniš status?')</p>
                <strong data-container="title"></strong>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Prekini')</button>
                <button type="submit" class="btn btn-danger">@lang('Izmeni')</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</form>
<!-- /.modal -->
@endsection

@push('head_links')
<link href="{{url('/themes/admin/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('/themes/admin/plugins/jquery-ui/jquery-ui.theme.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@push('script_tags')
<script src="{{url('/themes/admin/plugins/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>

<script type="text/javascript">
    $('#row-list-table').on('click', '[data-action="delete"]', function(e) {

        let id = $(this).attr('data-id');
        let title = $(this).attr('data-title');

        $('#delete-modal [name="id"]').val(id);
        $('#delete-modal [data-container="title"]').html(title);
    });

    $('#row-list-table').on('click', "[data-action='change-status']", function(e) {

        let id = $(this).attr('data-id');
        let title = $(this).attr('data-title');

        $('#change-modal [name="id"]').val(id);

        $('#change-modal [data-container="title"]').html(title);
    });

    $('#sortable-list').sortable({
        'handle': '.handle',
        'update': function(event, ui) {
            let sortedIDs = $("#sortable-list").sortable("toArray", {
                'attribute': 'data-id'
            });

            $('#change-priority-form [name="priorities"]').val(sortedIDs.join(','));
        }
    });

    $('[data-action="show-form"]').on('click', function(e) {
        $('[data-action="show-form"]').hide();
        $('#change-priority-form').show();
        $('#sortable-list .handle').show();
    });

    $('[data-action="hide-form"]').on('click', function(e) {
        $('#change-priority-form').hide();
        $('#sortable-list .handle').hide();
        $('[data-action="show-form"]').show();
        $("#sortable-list").sortable("cancel");
    });
</script>
@endpush