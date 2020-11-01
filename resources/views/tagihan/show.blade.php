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
						<div class="box-header with-border">
							<h3 class="box-title">Lihat Tagihan </h3>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="form-group col-6 ">
									<label for="">Nama Tagihan </label>
									{{ Form::text('name', $mPackages->id, array_merge(['class' => 'form-control','require'=>true,'readonly'=>true])) }}
								</div>
								<div class="form-group col-6 ">
									<label for="">Tipe Tagihan </label>
									<input type="text" class="form-control input-sm" name="date" value="{{ $mPackages->tipe }}" readonly>

								</div>
								<div class="form-group col-6 ">
									<label for="">Status Tagihan </label>
									<input type="text" class="form-control input-sm" name="date" value="{{ $billed->status }}" readonly>

								</div>
								<div class="form-group col-6">
									<label for="">Tanggal Tagihan </label>
									<input type="date" class="form-control input-sm" name="date" value="{{ $mPackages->date }}" readonly>
									<!-- /.input group -->
								</div>
								<div class="form-group col-6">
									<label for="">Jatuh Tempo </label>
									<input type="date" class="form-control input-sm" name="duedate" value="{{$mPackages->duedate}}" readonly>
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
										<label>Warga Pelangan </label>
										<select class="form-control select2" name='warga[]' multiple="multiple" style="width: 100%;" readonly>
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

									<table class="table table-striped table-bordered dataTable">
										<thead>
											<tr>
												<th style="width:6%!important">No</th>
												<th>Nama</th>
												<th>Keterangan</th>
												<th>Nominal</th>
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

						</div>
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
					<label>Warga Pelangan </label>
					<select class="form-control select2 tagihan" name='tagihan' style="width: 100%;">
						<option value="">== Pilih Pembayaran ==</option>
						@foreach ($dataAccount as $id => $name)
						<option value="{{ $name->code }}">{{ $name->desc }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label>Nominal Tagihan </label>
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
		$('.select2').select2({
			disabled: true

		});
		$('#datepicker').datepicker({
			autoclose: true,
			format: 'yyyy-mm-dd'
		})
		$('.btn-add-tagihan').click((e) => {
			e.preventDefault();
		});
		var dataTagihan = <?php echo $dataDetail ?>;
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

				html_code += "</tr>";
				totalTagihan = Number(totalTagihan) + Number(dataTagihan[i].nominal);
			});
			$('#tbody').html(html_code);
			$('.totalTagihan').val(new Intl.NumberFormat('id-ID', {
				style: 'currency',
				currency: 'IDR',
			}).format(totalTagihan));

		}
		rebuildTagihan();
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
				url: "{{route('tagihan.update',$mPackages->id)}}",
				method: "POST",
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