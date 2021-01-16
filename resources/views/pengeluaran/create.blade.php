@extends('adminlte::page')

@section('title', 'Buat Pengeluaran baru')

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
                        {!! Form::open(['route' => 'pengeluaran.store','class'=>'form-horizontal','id'=>"myForm",'autocomplete'=>"off"]) !!}
                        <div class="box-header with-border">
                            <h3 class="box-title">Buat Pengeluaran Baru</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-6 ">
                                    <label for="">Nama Kegiatan<span class="required">*</span> </label>
                                    {{ Form::text('name', null, array_merge(['class' => 'form-control','require'=>true])) }}
                                </div>

                                <div class="form-group col-6">
                                    <label for="">Tanggal <span class="required">*</span> </label>
                                    <input type="date" class="form-control input-sm" name="date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
                                    <!-- /.input group -->
                                </div>

                                <div class="form-group col-6">
                                    <label for="">Total Pengeluaran</label>
                                    <input type="text" class="form-control input-sm totalTagihan" name="total" value="" readonly>
                                    <!-- /.input group -->
                                </div>
                                <div class="form-group col-6" style="height: 150px;">
                                    <label>Keterangan </label>
                                    <textarea name="keterangan" class="form-control keterangan" style="height:100px;"></textarea>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-12">
                                    <div class="text-left"> <button data-toggle="modal" data-target="#modal" class='btn btn-sm btn-primary btn-flat btn-add-tagihan '><i class="fas fa-fw  fa-plus" aria-hidden="true"></i> Tambah Tipe Pengeluaran</button>
                                    </div>
                                    <table class="table table-striped table-bordered dataTable">
                                        <thead>
                                            <tr>
                                                <th style="width:6%!important">No</th>
                                                <!-- <th style="width:36%!important">Tipe Pengeluaran</th> -->
                                                <th style="width:36%!important">Keterangan</th>
                                                <th style="width:16%!important">Nominal</th>
                                                <th style=" width:6%!important">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id='tbody'>


                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <hr />
                        </div>
                        <div class="box-footer">
                            <a href="{{route('pengeluaran.index')}}" class="btn btn-info">Kembali</a>
                            <button type="reset" class="btn btn-danger">Batal</button>
                            <button type="submit" id="simpan" class="btn btn-success simpan">Simpan</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Tipe Pengeluaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Tipe Pengeluaran<span class="required">*</span></label>
                    <select class="form-control select2 tagihan" name='keperluan' style="width: 100%;">
                        <option value="">== Pilih Tipe Pengeluaran ==</option>
                        @foreach ($akun as $id => $name)
                        <option value="{{ $name->code }}">{{ $name->desc }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Nominal <span class="required">*</span></label>
                    <input type="text" class="form-control input-sm nominal" name="nominal" placeholder="Nominal yang dikeluarkan..." maxlength="30" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="acc-code" required>
                </div>
                <div class="form-group desc-form" id="formdesc">
                    <label>Keterangan </label>
                    <textarea name="desc" id="desc" class="form-control desc"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="saveBtn" value="create" class="btn btn-primary saveBtn">Tambahkan Pengeluaran</button>
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
        $('.btn-add-tagihan').click((e) => {
            e.preventDefault();
        });
        var dataTagihan = [];
        var count = 1;

        function hideshow() {
            var x = document.getElementById("formdesc");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
        $('.cbBulanan').click((e) => {
            hideshow();
        });
        $('.cbSekali').click((e) => {
            hideshow();
        });

        function rebuildTagihan() {
            var html_code = "";
            var totalTagihan = 0;
            dataTagihan.forEach((d, i) => {
                count = i + 1;
                html_code += "<tr id='" + dataTagihan[i].m_coas_id + "'>";
                html_code += "<td>" + count + "</td>";
                // html_code += "<td>" + dataTagihan[i].name + "</td>";
                html_code += "<td>" + dataTagihan[i].desc + "</td>";
                html_code += "<td>" + new Intl.NumberFormat('id-ID', {
                    // style: 'currency',
                    currency: 'IDR',
                }).format(dataTagihan[i].nominal) + "</td>";
                html_code += "<td><button type='button' name='remove' data-row='" + dataTagihan[i].m_coas_id + "' class='btn btn-sm btn-danger btn-flat remove'><i class='fas fa-fw fa-trash' aria-hidden='true'></i></button></td>";
                html_code += "</tr>";
                totalTagihan = Number(totalTagihan) + Number(dataTagihan[i].nominal);
            });
            $('#tbody').html(html_code);
            $('.totalTagihan').val(new Intl.NumberFormat('id-ID', {
                // style: 'currency',
                currency: 'IDR',
            }).format(totalTagihan));

        }
        $('.saveBtn').click((e) => {
            e.preventDefault();
            if ($('.tagihan').val() == "") {
                return;
            }
            if ($('.nominal').val() == "") {
                return;
            }
            var obj = {
                "name": $('.tagihan :selected').text(),
                "m_coas_id": $('.tagihan').val(),
                "desc": $('#desc').val(),
                "nominal": $('.nominal').val(),
                "cmp_id": "{{Auth::user()->cmp_id}}"
            };
            var isDuplicate = false;
            for (let el of dataTagihan) {
                if (el.id === $('.tagihan').val()) {
                    isDuplicate = true
                    break;
                }
            }
            if (!isDuplicate) {
                $('.nominal').val("");
                $('.desc').val("");

                dataTagihan.push(obj);
                console.log(dataTagihan);
                rebuildTagihan();
                $('#modal').modal('hide');
            } else {
                swal2("error", "Tagihan Sudah Di pilih.");
            }


        });


        $(document).on('click', '.remove', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-row');
            console.log(id);
            dataTagihan = dataTagihan.filter(function(d, i) {
                console.log(i + " " + id);
                return id !== d.id
            })
            console.log(dataTagihan)
            rebuildTagihan();


        });

        $('#simpan').click(function(e) {
            e.preventDefault()
            var datas = $('#myForm').serializeArray();
            datas.push({
                name: 'detail',
                value: JSON.stringify(dataTagihan)
            });
            console.log(datas);
            $.ajax({
                url: "{{route('pengeluaran.store')}}",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {
                    swal2('success', "Berhasil Di simpan");
                    window.location = "{{route('pengeluaran.index')}}";
                },
                error: function(xhr, status, error) {
                    var err = JSON.parse(xhr.responseText);
                    swal2('error', err.Message);
                }
            });
        });

    });
</script>
@stop