@extends('adminlte::page')

@section('title', 'List Pembayaran')

@section('content_header')
<h1 class="m-0 text-dark">List Pembayaran</h1>
@stop

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="box box-primary">
                    <div class="box-body">

                        @include('displayerror')
                        <table class="table table-striped table-bordered " style="width: 100%!important;" id="table2">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">No Tagihan</th>
                                    <th width="35%">Nama</th>
                                    <th width="10%">Status</th>
                                    <th width="15%">Total</th>
                                    <th witdh="10%">Status</th>
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

                    ajax: {
                        'url': "{!! route('dtpayment') !!}",
                        "type": "GET"
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'no',
                            name: 'no'
                        }, {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'note',
                            name: 'note'
                        }, {
                            data: 'totalTagihanRp',
                            name: 'totalTagihanRp'
                        },
                        {
                            data: 'status-tagihan',
                            name: 'status-tagihan'
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