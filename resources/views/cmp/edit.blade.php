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
                {!! Form::open(['route' => 'cmp.create','class'=>'form-horizontal']) !!}
                <h4>Info Lokasi Kegiatan</h4>
                <div class="row">

                    {{Form::token()}}
                    <div class="form-group col-6">
                        {{ Form::label('name', null, ['class' => 'control-label']) }}
                        {{ Form::text('name', null, array_merge(['class' => 'form-control'])) }}
                    </div>
                    <div class="form-group col-6 ">
                        {{ Form::label('Provinsi', null, ['class' => 'control-label']) }}

                        <select name="province" id="province" style="width:100%!important" class="form-control select2-provinsi">
                            <option value="">== Select Province ==</option>
                            @foreach ($provinsi as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-6 ">
                        {{ Form::label('Kabupaten', null, ['class' => 'control-label']) }}
                        <select name="kabupaten" id="kabupaten" style="width:100%!important" class="form-control select2 select2-hidden-accessible select2-kabupaten">
                            <option value="">== Select Kabupaten ==</option>
                        </select>
                    </div>
                    <div class="form-group col-6 ">
                        {{ Form::label('Kecamatan', null, ['class' => 'control-label']) }}
                        <select name="kecamatan" id="kecamatan" style="width:100%!important" class="form-control  select2-kecamatan">
                            <option value="">== Select Kecamatan ==</option>
                        </select>
                    </div>

                    <div class="form-group col-6 ">
                        {{ Form::label('Kelurahan', null, ['class' => 'control-label']) }}
                        <select name="kelurahan" id="kelurahan" style="width:100%!important" class="form-control select2-kelurahan">
                            <option value="">== Select Kelurahan ==</option>
                        </select>
                    </div>
                    <div class="form-group col-6 ">
                        {{ Form::label('alamat', null, ['class' => 'control-label']) }}
                        {{ Form::text('alamat', null, array_merge(['class' => 'form-control'])) }}
                    </div>

                </div>
                <h4>Warga Yang Di Daftarkan</h4>
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