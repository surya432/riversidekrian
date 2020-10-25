@extends('adminlte::page')

@section('title', 'Buat Tagihan baru')

@section('content_header')
<h1 class="m-0 text-dark"></h1>
@stop

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @include('displayerror')
                <div class="col-md-12">
                    <div class="box box-info">
                        {!! Form::open(['route' => 'cmp.store','class'=>'form-horizontal','autocomplete'=>"off"]) !!}
                        <div class="box-header with-border">
                            <h3 class="box-title">Buat Tagihan Baru</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-6 ">
                                    <label for="">Nama Tagihan<span class="required">*</span> </label>
                                    {{ Form::text('name', null, array_merge(['class' => 'form-control','require'=>true])) }}
                                </div>
                                <div class="form-group col-6 ">
                                    <label for="">Tipe Tagihan <span class="required">*</span> </label>
                                    <div class="form-control">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="tipe" name="tipe" value="Sekali">
                                            <label class="form-check-label" for="tipe" name="tipe">Sekali</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="inlineCheckbox2" name="tipe" value="Bulanan">
                                            <label class="form-check-label" for="inlineCheckbox2" name="tipe">Tiap Bulan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="">Tanggal Tagihan <span class="required">*</span> </label>
                                    <input type="date" class="form-control input-sm" name="tgl_faktur_code" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
                                    <!-- /.input group -->
                                </div>
                                <div class="form-group col-6">
                                    <label for="">Jatuh Tempo <span class="required">*</span> </label>
                                    <input type="date" class="form-control input-sm" name="duedate" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
                                    <!-- /.input group -->
                                </div>
                                <div class="form-group col-6">
                                    <label for="">Total Tagihan</label>
                                    <input type="text" class="form-control input-sm" name="duedate" value="60.000" readonly>
                                    <!-- /.input group -->
                                </div>
                                <div class="col-6">
                                    <div class="text-right" style="display: none;"> <button class='btn btn-sm btn-primary btn-flat '><i class="fas fa-fw  fa-plus" aria-hidden="true"></i> Pelangan</button>
                                    </div>
                                    <div class="form-group">
                                        <label>Warga Pelangan <span class="required">*</span></label>
                                        <select class="form-control select2" name='warga[]' multiple="multiple" style="width: 100%;">
                                            <option value="">== Pilih Warga ==</option>
                                            @foreach ($dataWarga as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-12">
                                    <div class="text-left"> <button class='btn btn-sm btn-primary btn-flat '><i class="fas fa-fw  fa-plus" aria-hidden="true"></i> Tagihan</button>
                                    </div>
                                    <table class="table table-striped table-bordered dataTable">
                                        <thead>
                                            <tr>
                                                <th style="width:6%!important">No</th>
                                                <th>Nama</th>
                                                <th>Nominal</th>
                                                <th style="width:6%!important">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Biaya Iuran Sampah</td>
                                                <td>Rp.20.000</td>
                                                <td class="nosort">
                                                    <div class="text-left"> <button class='btn btn-sm btn-danger btn-flat '><i class="fas fa-fw  fa-trash" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Biaya Iuran Rutin</td>
                                                <td>Rp.30.000</td>
                                                <td class="nosort">
                                                    <div class="text-left"> <button class='btn btn-sm btn-danger btn-flat '><i class="fas fa-fw  fa-trash" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Biaya Iuran Sosial</td>
                                                <td>Rp.10.000</td>
                                                <td class="nosort">
                                                    <div class="text-left"> <button class='btn btn-sm btn-danger btn-flat '><i class="fas fa-fw  fa-trash" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <hr />
                        </div>
                        <div class="box-footer">
                            <a href="{{route('tagihan.index')}}" class="btn btn-info">Kembali</a>
                            <button type="reset" class="btn btn-danger">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                        {!! Form::close() !!}
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
        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        })
        var count = 1;
        $('#add').click(function() {
            count = count + 1;
            var html_code = "<tr id='row" + count + "'>";
            html_code += "<td contenteditable='true' class='item_name'></td>";
            html_code += "<td contenteditable='true' class='item_code'></td>";
            html_code += "<td contenteditable='true' class='item_desc'></td>";
            html_code += "<td contenteditable='true' class='item_price' ></td>";
            html_code += "<td><button type='button' name='remove' data-row='row" + count + "' class='btn btn-danger btn-xs remove'>-</button></td>";
            html_code += "</tr>";
            $('#crud_table').append(html_code);
        });

        $(document).on('click', '.remove', function() {
            var delete_row = $(this).data("row");
            $('#' + delete_row).remove();
        });

        $('#save').click(function() {
            var item_name = [];
            var item_code = [];
            var item_desc = [];
            var item_price = [];
            $('.item_name').each(function() {
                item_name.push($(this).text());
            });
            $('.item_code').each(function() {
                item_code.push($(this).text());
            });
            $('.item_desc').each(function() {
                item_desc.push($(this).text());
            });
            $('.item_price').each(function() {
                item_price.push($(this).text());
            });
            $.ajax({
                url: "insert.php",
                method: "POST",
                data: {
                    item_name: item_name,
                    item_code: item_code,
                    item_desc: item_desc,
                    item_price: item_price
                },
                success: function(data) {
                    alert(data);
                    $("td[contentEditable='true']").text("");
                    for (var i = 2; i <= count; i++) {
                        $('tr#' + i + '').remove();
                    }
                    fetch_item_data();
                }
            });
        });

    });
</script>
@stop