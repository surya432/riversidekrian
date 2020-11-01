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
                        {{-- <div class="">
            <a href="{{route('coa.create')}}" class="btn btn-success btn-md">
                        <i class="fa fa-plus"></i> Buat Data
                        </a>
                    </div> --}}
                    @include('displayerror')
                    <br>
                    <table class="table table-striped table-bordered dataTable" style="width: 100%!important;" id="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Var</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th class="nosort">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($interface as $data)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td> <a href="{{ route('interface-detail',$data->id) }}"> {{ strtoupper($data->var)}} </a> </td>
                                <td>{{ucfirst($data->desc)}}</td>
                                <td> <span for="" class="label {{ ( $data->status == 'active') ? 'label-success' : 'label-warning'  }}"></span> {{ucfirst($data->status)}}</td>
                                <td>
                                    <a href="{{ route('minteface.edit',$data->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fa fa-edit"></i></a>

                                    {{-- <a href="{{ route('coa.delete',$data->id) }}" onclick="return confirm('Apakah Anda Yakin Untuk Menghapus ?')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus">
                                    <i class="fa fa-trash"></i>
                                    </a> --}}
                                </td>
                            </tr>
                            @endforeach
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