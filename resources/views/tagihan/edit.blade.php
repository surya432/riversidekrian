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
                <div class="col-md-12 col-md-offset-2">
                    <div class="box box-info">
                        <form class="" action="{{ route('coa.update',$coa->id) }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            {{ method_field('PATCH') }}
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="" class="control-label">Kategori <span class="required">*</span></label>
                                            <select class="form-control input-sm" name="grup" required>
                                                <option value="">Pilih Kategori...</option>
                                                <option @if( $coa->grup == 'ASSET' ) selected="" @endif value="ASSET">ASSET</option>
                                                <option @if( $coa->grup == 'LIABILITY' ) selected="" @endif value="LIABILITY">LIABILITY</option>
                                                <option @if( $coa->grup == 'CAPITAL' ) selected="" @endif value="CAPITAL">CAPITAL</option>
                                                <option @if( $coa->grup == 'REVENUE' ) selected="" @endif value="REVENUE">REVENUE</option>
                                                <option @if( $coa->grup == 'EXPENSE' ) selected="" @endif value="EXPENSE">EXPENSE</option>
                                            </select>
                                        </div>
                                        @if( $coa->parent_id != 0 )
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="has_parent" checked="">
                                                    Has Parent
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group" id="parent-form">
                                            <label for="" class="control-label">Parent <span class="required">*</span></label>
                                            <select class="form-control input-sm select2" name="parent_id" id="select-parent-form" style="width: 100%" disabled="">
                                                <option value="">Pilih Parent...</option>
                                                @foreach($coaParent as $data)
                                                <option data-id="{{ $data->id }}" value="{{ $data->id }}" @if($data->id == $coa->parent_id) selected="" @endif>{{ ucfirst($data->desc) }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="">Kode Akun</label>
                                            <input type="text" class="form-control input-sm" name="code" placeholder="Kode Akun..." maxlength="30" readonly="" value="{{ $coa->code }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="">Nama Akun <span class="required">*</span></label>
                                            <input type="text" name="desc" class="form-control input-sm" required="" placeholder="Nama Akun..." maxlength="40" value="{{ $coa->desc }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label">Debet / Kredit <span class="required">*</span></label>
                                            <select class="form-control input-sm" name="debet_credit" required>
                                                <option value="">Pilih Debet / Kredit...</option>
                                                <option @if( $coa->debet_credit == 'debet' ) selected="" @endif value="debet">DEBET</option>
                                                <option @if( $coa->debet_credit == 'credit' ) selected="" @endif value="credit">KREDIT</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <div class="pull-right">
                                    <a href="{{route('coa.index')}}" class="btn btn-info">Kembali</a>
                                    <button type="reset" class="btn btn-danger">Batal</button>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
                </div>
            </div>
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