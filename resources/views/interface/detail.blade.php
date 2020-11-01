@extends('adminlte::page')

@section('treeview_master','active')
@section('treeview_interface','active')

@section('title','Detail Interface')

@section('customcss')
<link rel="stylesheet" href="{{URL::asset('css/datatables.min.css')}}">
@stop

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-12">
                                        <table>
                                            <tr>
                                                <td>No. Interface</td>
                                                <td>&nbsp; : &nbsp;</td>
                                                <td>{{$data_interface->id}}</td>
                                            </tr>
                                            <tr>
                                                <td>Nama Var</td>
                                                <td>&nbsp; : &nbsp;</td>
                                                <td>{{$data_interface->var}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-2"></div>
                                    <div class="col-12">
                                        <table>
                                            <tr>
                                                <td>Deskripsi</td>
                                                <td>&nbsp; : &nbsp;</td>
                                                <td style="text-align: right;">{{$data_interface->desc}}</td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>&nbsp; : &nbsp;</td>
                                                <td style="text-align: right;">{{ucfirst($data_interface->status)}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <br><br>
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-striped table-bordered dataTable" style="width: 100%!important;" id="table">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center; width: 50px;">No.</th>
                                                    <th style="text-align: center; ">Kode</th>
                                                    <th style="text-align: center;">Deskripsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1 ?>
                                                @foreach($data as $raw_data)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$raw_data->code}}</td>
                                                    <td>{{$raw_data->desc}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="pull-left">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('customscripts')
<script type="text/javascript" src="{{URL::asset('/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('/js/datatables.bootstrap.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#table').DataTable({
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
        });
    });
</script>
@stop