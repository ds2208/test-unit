@extends('admin._layout.layout')

@section('seo_title', __('Komentari'))

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang("Komentari")</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.index.index')}}">
                            @lang('Početna')
                        </a>
                    </li>
                    <li class="breadcrumb-item active">@lang('Komentari')</li>
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
                        <h3 class="card-title">{{__("Pretraži komentare")}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form id="entities-filter-form">
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label>{{__("Pretraži po id merenja")}}</label>
                                    <input 
                                        name="measurement_id" 
                                        value="" 
                                        type="text" 
                                        class="form-control" 
                                        placeholder="Search by measurement id"
                                        >
                                </div>
                                <div class="col-md-1 form-group">
                                    <label>{{__("Status")}}</label>
                                    <select name="index" class="form-control">
                                        <option value="">-- {{__("Svi")}} --</option>
                                        <option value="1">{{__("Aktivni")}}</option>
                                        <option value="0">{{__("Neaktivni")}}</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@lang('Svi komentari')</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="row-list-table" class="table table-bordered">
                            <thead>                  
                                <tr>
                                    <th style="width: 10%;"class="text-center">{{__("Ime")}}</th>
                                    <th class="text-center">{{__("Status")}}</th>
                                    <th class="text-center">{{__("E-mail")}}</th>
                                    <th class="text-center">{{__("Sadržaj")}}</th>
                                    <th class="text-center">{{__("Naziv merenja")}}</th>
                                    <th class="text-center">{{__("Kreirano")}}</th>
                                    <th style="width: 10%;" class="text-center">{{__("Akcije")}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                
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
<div class="modal fade" id="content-modal">
    <input type="hidden" name="id" value="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{__("Sadržaj komentara")}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <small><em data-container="email"></em></small>
                <h3 data-container="name"></h3>
                <strong data-container="content"></strong>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-warning" data-dismiss="modal">{{__("OK")}}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<form action="{{route('admin.comments.disable')}}" class="modal fade" id="disable-modal">
    @csrf
    <input type="hidden" name="id" value="">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{__("Deaktiviraj komentar")}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{__("Da li si siguran da želiš da deaktiviraš komentar?")}}</p>
                <strong data-container="name"></strong>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__("Prekini")}}</button>
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-minus-circle"></i>
                    {{__("Deaktiviraj")}}
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</form>
<!-- /.modal -->
<form action="{{route('admin.comments.enable')}}" method="post" class="modal fade" id="enable-modal">
    @csrf
    <input type="hidden" name="id" value="">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{__("Aktiviraj komentar")}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{__("Da li si siguran da želiš da aktiviraš komentar?")}}</p>
                <strong data-container="name"></strong>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__("Prekini")}}</button>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-check"></i>
                    {{__("Aktiviraj")}}
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</form>
<!-- /.modal -->
@endsection

@push('script_tags')
<script type="text/javascript">
    //SELECT2
   $('#entities-filter-form [name="index"]').select2({
       theme: 'bootstrap4'
   });

    $('#entities-filter-form [name]').on('change keyup', function (e) {
        e.preventDefault();
        $('#entities-filter-form').trigger('submit');
    });
    $('#entities-filter-form').on('submit', function (e) {
        e.preventDefault();
        entitiesDataTable.ajax.reload(null, true);
    });

    let entitiesDataTable = $('#row-list-table').DataTable({
        'serverSide': true,
        'processing': true,
        'ajax': {
            'url': "{{route('admin.comments.datatable')}}",
            'type': 'post',
            'data': function (dtData) {
                dtData['_token'] = '{{csrf_token()}}';
                dtData['measurement_id'] = $('#entities-filter-form [name="measurement_id"]').val();
                dtData['index'] = $('#entities-filter-form [name="index"]').val();
            }
        },
        'pageLength': 5,
        'lengthMenu': [5, 10, 20],
        'order': [[4, 'desc']],
        'columns': [
            {'name': 'name', 'data': 'name'},
            {'name': 'index', 'data': 'index'},
            {'name': 'email', 'data': 'email', "orderable": false},
            {'name': 'content', 'data': 'content', "searchable": false},
            {'name': 'measurement_title', 'data': 'measurement_title', "searchable": false, "orderable": false},
            {'name': 'created_at', 'data': 'created_at', "searchable": false},
            {'name': 'actions', 'data': 'actions', "searchable": false, "orderable": false, "class":"text-center"}
        ]
    });
    
    $('#row-list-table').on('click', '[data-action="content"]', function (e) {
        let content = $(this).attr('data-content');
        let email = $(this).attr('data-email');
        let name = $(this).attr('data-name');
        $('#content-modal [data-container="content"]').html(content);
        $('#content-modal [data-container="name"]').html(name);
        $('#content-modal [data-container="email"]').html(email);
    });


    //enable modal
    $('#row-list-table').on('click', '[data-action="enable"]', function (e) {
        let id = $(this).attr('data-id');
        let name = $(this).attr('data-name');
        $('#enable-modal [name="id"]').val(id);
        $('#enable-modal [data-container="name"]').html(name);
    });
    $('#enable-modal').on('submit', function (e) {
        e.preventDefault();
        $(this).modal('hide');
        $.ajax({
            "url": $(this).attr('action'),
            "type": "post",
            "data": $(this).serialize()
        }).done(function (response) {
            toastr.success(response.system_message);
            entitiesDataTable.ajax.reload(null, false);
        }).fail(function (xhr) {
            let systemError = "@lang('Error occured while enable comment')";
            if (xhr.responseJSON && xhr.responseJSON['system_error']) {
                systemError = xhr.responseJSON['system_error'];
            }
            toastr.error(systemError);
        });
    });

    //disable modal
    $('#row-list-table').on('click', '[data-action="disable"]', function (e) {
        let id = $(this).attr('data-id');
        let name = $(this).attr('data-name');
        $('#disable-modal [name="id"]').val(id);
        $('#disable-modal [data-container="name"]').html(name);
    });
    $('#disable-modal').on('submit', function (e) {
        e.preventDefault();
        $(this).modal('hide');
        $.ajax({
            "url": $(this).attr('action'),
            "type": "post",
            "data": $(this).serialize()
        }).done(function (response) {
            toastr.success(response.system_message);
            entitiesDataTable.ajax.reload(null, false);
        }).fail(function (xhr) {
            let systemError = "@lang('Error occured while disable comment')";
            if (xhr.responseJSON && xhr.responseJSON['system_error']) {
                systemError = xhr.responseJSON['system_error'];
            }
            toastr.error(systemError);
        });
    });
</script>
@endpush