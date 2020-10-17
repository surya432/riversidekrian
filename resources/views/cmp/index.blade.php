@extends('adminlte::page')

@section('title', 'List CMP')

@section('content_header')
<h1 class="m-0 text-dark">List CMP code</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-body">

                <div class="dataTables_wrapper dt-bootstrap4">
                    <div class="box-body">
                        <a style="margin-bottom:20px" href="{{ route('cmp.create') }}" class="btn btn-primary btn-sm btn-flat">
                            Add CMP
                        </a>
                        <table class="table table-striped table-bordered dataTable" style="width: 100%!important;" id="table">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="45%">Name</th>
                                    <th width="40%">Alamat</th>
                                    <th witdh="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal" id="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                    </div>
                </div>
            </div>
        </div>
    </div>
    @stop
    @section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            table =
                $('#table').DataTable({
                    //server-side
                    processing: true,
                    serverSide: true,
                    ajax: {
                        'url': "{!! route('dtcmp') !!}",
                        "type": "GET"
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'alamat',
                            name: 'alamat'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                    ]
                });
        });
    </script>
    @stop