@extends('adminlte::page')

@section('title', 'List Pengeluaran')

@section('content_header')
<h1 class="m-0 text-dark">List Pengeluaran</h1>
@stop

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="">
                            <a href="{{route('pengeluaran.create')}}" class="btn btn-success btn-md">
                                <i class="fa fa-plus"></i> Buat Pengeluaran baru
                            </a>
                        </div>
                        <br>
                        @include('displayerror')
                        <table class="table table-striped table-bordered " style="width: 100%!important;" id="table2">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="45%">Name Kegiatan</th>
                                    <th width="30%">Tanggal</th>
                                    <th witdh="10%">Status</th>
                                    {{-- <th>Status</th> --}}
                                    <th witdh="10%" class="nosort">Aksi</th>
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
            table =
                $('#table2').DataTable({
                    //server-side
                    processing: true,
                    serverSide: true,
                    ajax: {
                        'url': "{!! route('tagihandt') !!}",
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
                            data: 'tipe',
                            name: 'tipe'
                        },
                        {
                            data: 'status',
                            name: 'status'
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