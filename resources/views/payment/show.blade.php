@extends('adminlte::page')

@section('title', 'Lihat Detail Pembayaran')

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
							<h3 class="box-title">Lihat Detail Pembayaran</h3>


						</div>
						<div class="box-body">
							<div class="row">
								<div class="form-group col-6 ">
									<label for="">No Tagihan </label>
									{{ Form::text('name', $data->no, array_merge(['class' => 'form-control','require'=>true,'readonly'=>true])) }}
								</div>
								<div class="form-group col-6 ">
									<label for="">Tipe Tagihan </label>
									{{ Form::text('tipe', $data->payment->tipe, array_merge(['class' => 'form-control','require'=>true,'readonly'=>true])) }}

								</div>
								<div class="form-group col-6">
									<label for="">Nama</label>
									{{ Form::text('name', $data->userdetail->name, array_merge(['class' => 'form-control','require'=>true,'readonly'=>true])) }} <!-- /.input group -->
								</div>
								<div class="form-group col-6 ">
									<label for="">Status Tagihan </label>
									{{ Form::text('status', $data->status, array_merge(['class' => 'form-control','require'=>true,'readonly'=>true])) }}
								</div>
								<div class="form-group col-6">
									<label for="">Tanggal Tagihan </label>
									<input type="date" class="form-control input-sm" name="date" value="{{ $data->date }}" readonly>
									<!-- /.input group -->
								</div>
								<div class="form-group col-6">
									<label for="">Total Tagihan </label>
									<input type="text" class="form-control input-sm totalTagihan" name="duedate" value="{{$data->totalTagihan}}" readonly>
									<!-- /.input group -->
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
						<a href="{{route('payment.index')}}" class="btn btn-info">Kembali</a>

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

		var dataTagihan = <?php echo $data->payment->detailpayment ?>;
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
				html_code += "<td>Rp. " + dataTagihan[i].nominal + "</td>";;

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


	});
</script>
@stop