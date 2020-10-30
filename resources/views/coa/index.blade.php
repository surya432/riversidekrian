@extends('adminlte::page')

@section('title', 'List COA')

@section('content_header')
<h1 class="m-0 text-dark">List COA code</h1>
@stop

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-body">

                <div class="box box-primary">
                    <div class="box-body">
                        <div class="">
                            <a href="{{route('coa.create')}}" class="btn btn-success btn-md">
                                <i class="fa fa-plus"></i> Buat Data
                            </a>
                        </div>
                        <br>
                        @include('displayerror')
                        <table class="table table-striped table-bordered dataTable" style="width: 100%!important;" id="table2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode</th>
                                    <th>Deskripsi</th>
                                    <th>Debet / Kredit</th>
                                    <th>Group</th>
                                    {{-- <th>Status</th> --}}
                                    <th class="nosort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @stop
    @section('js')
    <script>
        $(document).ready(function() {
            $('#table2').DataTable({
                "language": {
                    "emptyTable": "Data Kosong",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                    "infoFiltered": "(disaring dari _MAX_ total data)",
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ Data",
                    "zeroRecords": "Tidak Ada Data yang Ditampilkan",
                    "oPaginate": {
                        "sFirst": "Awal",
                        "sLast": "Akhir",
                        "sNext": "Selanjutnya",
                        "sPrevious": "Sebelumnya"
                    },
                },

                processing: true,
                serverSide: true,
                ajax: '<?= route('dtcoa') ?>',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'desc',
                        name: 'desc'
                    },
                    {
                        data: 'debet_credit',
                        name: 'debet_credit'
                    },
                    {
                        data: 'grup',
                        name: 'grup'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
    @stop