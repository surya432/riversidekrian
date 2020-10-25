@extends('adminlte::page')

@section('title', 'Buat COA baru')

@section('content_header')
<h1 class="m-0 text-dark"></h1>
@stop

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @include('displayerror')
                <div class="col-md-12 col-md-offset-2">
                    <div class="box box-info">
                        <form class="" action="{{ route('coa.store') }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            {{ method_field('post') }}
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="" class="control-label">Kategori <span class="required">*</span></label>
                                            <select class="form-control input-sm" name="grup" required>
                                                <option value="">Pilih Kategori...</option>
                                                <option value="ASSET">ASSET</option>
                                                <option value="LIABILITY">LIABILITY</option>
                                                <option value="CAPITAL">CAPITAL</option>
                                                <option value="REVENUE">REVENUE</option>
                                                <option value="EXPENSE">EXPENSE</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="has_parent">
                                                    Has Parent
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group" id="parent-form" style="display: none;">
                                            <label for="" class="control-label">Parent <span class="required">*</span></label>
                                            <select class="form-control input-sm select2" name="parent_id" id="select-parent-form" style="width: 100%">
                                                <option value="">Pilih Parent...</option>
                                                @foreach($coa as $data)
                                                <option data-id="{{ $data->id }}" value="{{ $data->id }}">{{ ucfirst($data->desc) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row">
                                            <label for="" class="col-sm-12">Kode Akun</label>
                                            <div class="">
                                                <div class="col-md-6" id="parent-code-form" style="display: none">
                                                    <input type="text" readonly="" class="form-control input-sm" name="parent_code" id="parent-code">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control input-sm" name="code" placeholder="Kode Akun..." maxlength="30" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="acc-code" required>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="">Nama Akun <span class="required">*</span></label>
                                            <input type="text" name="desc" class="form-control input-sm" required="" placeholder="Nama Akun..." maxlength="40">
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label">Debet / Kredit <span class="required">*</span></label>
                                            <select class="form-control input-sm" name="debet_credit" required>
                                                <option value="">Pilih Debet / Kredit...</option>
                                                <option value="debet">DEBET</option>
                                                <option value="credit">KREDIT</option>
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
        $('.select2').select2();

        $(document).on('change', '#has_parent', function() {
            if (this.checked) {
                $('#parent-form').show();
                $('#parent-code-form').show();
                $('#select-parent-form').attr('required', true);
                $('#acc-code').attr('maxlength', 2);
            } else {
                $('#parent-form').hide();
                $('#select-parent-form').val('').trigger('change');
                $('#parent-code-form').hide();
                $('#parent-code').val('');
                $('#select-parent-form').attr('required', false);
                $('#acc-code').attr('maxlength', 30);
            }
        });

        $('#select-parent-form').on('change', function() {
            // const data = $(this).serialize();
            var id = $(this).val();
            if (id == '') {
                $('#parent-code').attr('placeholder', 'Pilih Parent...');
            }
            var urls = '{{ route("dtgetParent","") }}' + "/" + id;
            // urls = urls.replace('id', id);
            $.ajax({
                url: urls,
                method: "GET",
                success: function(data) {
                    // alert(data);
                    $('#parent-code').val(data.code);
                }
            })
        });
    });
</script>
@stop