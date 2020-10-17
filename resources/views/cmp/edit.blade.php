@extends('adminlte::page')

@section('title', 'Buat CMP baru')

@section('content_header')
<h1 class="m-0 text-dark"></h1>
@stop

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => ['cmp.update', $cmp->id],'class'=>'form-horizontal','method' => 'put']) !!}
                <h4>Info Lokasi Kegiatan</h4>
                <div class="row">

                    {{Form::token()}}
                    <div class="form-group col-6">
                        {{ Form::label('name', null, ['class' => 'control-label']) }}
                        {{ Form::text('name', $cmp->name, array_merge(['class' => 'form-control'])) }}
                    </div>
                    <div class="form-group col-6 ">
                        {{ Form::label('Provinsi', null, ['class' => 'control-label']) }}

                        {{ Form::select('provinsi_id', $provinsi, $cmp->provinsi_id, ['class'=>'form-control  select2-provinsi','style'=>'width:100%!important"']) }}
                    </div>

                    <div class="form-group col-6 ">
                        {{ Form::label('Kabupaten', null, ['class' => 'control-label']) }}
                        {{ Form::select('kabupaten_id', $kabupaten, $cmp->kabupaten_id, ['class'=>'form-control  select2-kabupaten','style'=>'width:100%!important"']) }}
                    </div>
                    <div class="form-group col-6 ">
                        {{ Form::label('Kecamatan', null, ['class' => 'control-label']) }}
                        {{ Form::select('kecamatan_id', $kecamatan, $cmp->kecamatan_id, ['class'=>'form-control  select2-kecamatan','style'=>'width:100%!important"']) }}

                    </div>

                    <div class="form-group col-6 ">
                        {{ Form::label('Kelurahan', null, ['class' => 'control-label']) }}
                        {{ Form::select('kelurahan_id', $kelurahan, $cmp->kelurahan_id, ['class'=>'form-control  select2-kelurahan','style'=>'width:100%!important"']) }}
                    </div>
                    <div class="form-group col-6 ">
                        {{ Form::label('tipe', null, ['class' => 'control-label']) }}
                        <?php $dataTipe = array('Desa' => 'Desa', 'Perumahan' => 'Perumahan'); ?>
                        {{ Form::select('tipe', $dataTipe, $cmp->tipe, ['class'=>'form-control ','style'=>'width:100%!important"']) }}

                    </div>
                    <div class="form-group col-6 ">
                        {{ Form::label('alamat', null, ['class' => 'control-label']) }}
                        {{ Form::text('alamat', $cmp->alamat, array_merge(['class' => 'form-control'])) }}
                    </div>

                </div>
                {{Form::submit()}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @stop
    @section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2-provinsi').select2({});
            $('.select2-kabupaten').select2({});
            $('.select2-kecamatan').select2({});
            $('.select2-kelurahan').select2({});

            $('.select2-provinsi').on('change', function() {
                var id = $(this).val();
                axios.get("/api/kabupaten/" + id)
                    .then(function(response) {
                        $('.select2-kabupaten').empty();
                        $.each(response.data, function(id, name) {
                            $('.select2-kabupaten').append(new Option(name, id))
                        })
                    });
            });
            $('.select2-kabupaten').on('change', function() {
                var id = $(this).val();
                axios.get("/api/kecamatan/" + id)
                    .then(function(response) {
                        $('.select2-kecamatan').empty();
                        $.each(response.data, function(id, name) {
                            $('.select2-kecamatan').append(new Option(name, id))
                        })
                    });
            });
            $('.select2-kecamatan').on('change', function() {
                var id = $(this).val();
                axios.get("/api/kelurahan/" + id)
                    .then(function(response) {
                        $('.select2-kelurahan').empty();
                        $.each(response.data, function(id, name) {
                            $('.select2-kelurahan').append(new Option(name, id))
                        })
                    });
            });
        });
    </script>
    @stop