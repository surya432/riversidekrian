@extends('template.app')

@section('treeview_accounting','active')
@section('treeview_saldo_awal','active')
@section('treeview_sa_coa','active')

@section('headertitle','Saldo Awal COA')

@section('customcss')
<link rel="stylesheet" href="{{URL::asset('css/datatables.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/bootstrap-datepicker.min.css')}}">
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-body">
            <div class="">
                <a href="{{url('admin/accounting/saldo-awal-coa-create')}}" class="btn btn-success btn-md">
                    <i class="fa fa-plus"></i> Buat Data
                </a>
                {{-- <a href="{{ route('MSaldoAwalCoa.export') }}" class="btn btn-primary btn-md">
                    <i class="fa fa-sign-out"></i> Export Excel
                </a> --}}
            </div>
            @include('admin.displayerror')
            <table class="table table-striped table-hover table-responsive" id="table">
                <thead>
                    <tr>
                        <th style="text-align: center;">No.</th>
                        <th style="text-align: center;">Kode</th>
                        <th style="text-align: center;">Deskripsi</th>
                        <th style="text-align: center;">Total</th>
                        <th style="text-align: center;">Tanggal</th>
                        <th style="text-align: center;">Keterangan</th>
                        <th style="text-align: center;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach($data as $result)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $result->code }}</td>
                            <td>{{ $result->desc }}</td>
                            <td>Rp.{{ number_format($result->total,0,'.','.') }}</td>
                            <td>{{ date('d-m-Y',strtotime($result->date)) }}</td>
                            <td>{{ $result->keterangan }}</td>
                            <td>{{ ucfirst($result->status) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
@stop

@section('customscripts')
    <script type="text/javascript" src="{{URL::asset('/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/js/datatables.bootstrap.min.js')}}"></script>

    <script>
        $(document).ready(function(){
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
