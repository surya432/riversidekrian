@extends('adminlte::page')

@section('title', 'Buat Tagihan baru')

@section('content_header')
<h1 class="m-0 text-dark">Edit</h1>
@stop

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @include('displayerror')
                <div class="col-md-12">
                    <div class="box box-info">
                        {!! Form::open(['route' => 'cmp.store','class'=>'form-horizontal','id'=>"myForm",'autocomplete'=>"off"]) !!}
                        <div class="box-header with-border">
                            <h3 class="box-title">Buat Tagihan Baru</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-6 ">
                                    <label for="">Nama Tagihan<span class="required">*</span> </label>
                                    {{ Form::text('name', $mPackages->id, array_merge(['class' => 'form-control','require'=>true,'readonly'=>true])) }}
                                </div>
                                <div class="form-group col-6 ">
                                    <label for="">Tipe Tagihan <span class="required">*</span> </label>
                                    <div class="form-control">
                                        @if($mPackages->tipe != "Bulanan")
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="tipe" name="tipe" value="Sekali" <?php if ($mPackages->tipe == "Sekali") echo "checked"; ?>>
                                            <label class="form-check-label" for="tipe" name="tipe">Sekali</label>
                                        </div>
                                        @endif
                                        @if($mPackages->tipe != "Sekali")
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="inlineCheckbox2" name="tipe" value="Bulanan" <?php if ($mPackages->tipe == "Bulanan") echo "checked"; ?>>
                                            <label class="form-check-label" for="inlineCheckbox2" name="tipe">Tiap Bulan</label>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @if($mPackages->tipe != "Sekali" && $billed->status == "Aktif")
                                <div class="form-group col-6 ">
                                    <label for="">Status Tagihan <span class="required">*</span> </label>
                                    <div class="form-control">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="status" name="status" value="Aktif" <?php if ($billed->status == "Aktif") echo "checked"; ?>>
                                            <label class="form-check-label" for="status" name="status">Aktif</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="inlineCheckbox2status" name="status" value="Tidak Aktif" <?php if ($billed->status == "Tidak Aktif") echo "checked"; ?>>
                                            <label class="form-check-label" for="inlineCheckbox2status" name="status">Tidak Aktif</label>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="form-group col-6">
                                    <label for="">Tanggal Tagihan <span class="required">*</span> </label>
                                    <input type="date" class="form-control input-sm" name="date" value="{{ $mPackages->date }}" required>
                                    <!-- /.input group -->
                                </div>
                                <div class="form-group col-6">
                                    <label for="">Jatuh Tempo <span class="required">*</span> </label>
                                    <input type="date" class="form-control input-sm" name="duedate" value="{{$mPackages->duedate}}" required>
                                    <!-- /.input group -->
                                </div>
                                <div class="form-group col-6">
                                    <label for="">Total Tagihan</label>
                                    <input type="text" class="form-control input-sm totalTagihan" name="totalTagihan" value="{{$billed->totalTagihan}}" readonly>
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
                                            <option value="{{ $id }}" <?php if (in_array($id, json_decode($billed->user_id, true))) {
                                                                            echo "selected";
                                                                        } ?>>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-12">
                                    <!-- <div class="text-left"> <button data-toggle="modal" data-target="#modal" class='btn btn-sm btn-primary btn-flat btn-add-tagihan '><i class="fas fa-fw  fa-plus" aria-hidden="true"></i> Tagihan</button>
                                    </div> -->
                                    <table class="table table-striped table-bordered dataTable">
                                        <thead>
                                            <tr>
                                                <th style="width:6%!important">No</th>
                                                <th>Nama</th>
                                                <th>Keterangan</th>
                                                <th>Nominal</th>
                                                <!-- <th style="width:6%!important">Action</th> -->
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
                            <a href="{{route('tagihan.index')}}" class="btn btn-info">Kembali</a>
                            @if($mPackages->tipe != "Sekali" && $billed->status == "Aktif")
                            <button type="reset" class="btn btn-danger">Batal</button>
                            <button type="submit" id="simpan" class="btn btn-success simpan">Simpan</button>
                            @endif
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
                <h5 class="modal-title">Tambah Tagihan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Warga Pelangan <span class="required">*</span></label>
                    <select class="form-control select2 tagihan" name='tagihan' style="width: 100%;">
                        <option value="">== Pilih Pembayaran ==</option>
                        @foreach ($dataAccount as $id => $name)
                        <option value="{{ $name->code }}">{{ $name->desc }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Nominal Tagihan <span class="required">*</span></label>
                    <input type="text" class="form-control input-sm nominal" name="nominal" placeholder="Nominal Tagihan..." maxlength="30" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="acc-code" required>
                </div>
                <div class="form-group">
                    <label>Keterangan </label>
                    <textarea name="desc" class="form-control desc"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="saveBtn" value="create" class="btn btn-primary saveBtn">Tambahkan Tagihan</button>
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

        function rebuildTagihan() {
            var html_code = "";
            var totalTagihan = 0;
            dataTagihan.forEach((d, i) => {
                count = i + 1;
                html_code += "<tr id='" + dataTagihan[i].m_coas_id + "'>";
                html_code += "<td>" + count + "</td>";
                html_code += "<td>" + dataTagihan[i].name + "</td>";
                html_code += "<td>" + dataTagihan[i].desc + "</td>";
                html_code += "<td>" + new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                }).format(dataTagihan[i].nominal) + "</td>";
                // html_code += "<td><button type='button' name='remove' data-row='" + dataTagihan[i].m_coas_id + "' class='btn btn-sm btn-danger btn-flat remove'><i class='fas fa-fw fa-trash' aria-hidden='true'></i></button></td>";
                html_code += "</tr>";
                totalTagihan = Number(totalTagihan) + Number(dataTagihan[i].nominal);
            });
            $('#tbody').html(html_code);
            $('.totalTagihan').val(new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
            }).format(totalTagihan));

        }

        function rebuildTagihan2() {
            var datas = <?php echo $dataDetail ?>;
            datas.forEach((m, i) => {
                dataTagihan.push(m);
            });
            rebuildTagihan();
        };
        rebuildTagihan2();
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
                "desc": $('.desc').val(),
                "nominal": $('.nominal').val(),
                "cmp_id": "{{Auth::user()->cmp_id}}"
            };
            var isDuplicate = false;
            for (let el of dataTagihan) {
                if (el.m_coas_id === $('.tagihan').val()) {
                    isDuplicate = true
                    break;
                }
            }
            if (!isDuplicate) {
                $('.nominal').val("");
                $(".tagihan").val('').trigger('change')

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
                return id !== d.m_coas_id
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
                url: "{{route('tagihan.update',$mPackages->id)}}",
                method: "PATCH",
                data: datas,
                dataType: "json",
                success: function(data) {
                    swal2('success', "Berhasil Di simpan");
                    window.location = "{{route('tagihan.index')}}";
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