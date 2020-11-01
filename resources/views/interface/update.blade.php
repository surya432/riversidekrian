@extends('adminlte::page')

@section('treeview_master','active')
@section('treeview_interface','active')

@section('title','Master Interface')

@section('customcss')
<link rel="stylesheet" href="{{URL::asset('plugins/select2.min.css')}}">
<link href="{{asset('css/select2-bootstrap.min.css')}}" rel="stylesheet" />
<style>
	.required {
		font-size: 12px;
		color: red;
		font-weight: bold;
	}
</style>
@stop

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">

			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<div class="box box-info">
							<form class="" action="{{ route('minteface.update',$data->id) }}" method="post">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="code_coa" id="usecoa">
								{{ method_field('PATCH') }}
								<div class="box-body">
									@include('displayerror')
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="">Var</label>
												<input type="text" class="form-control input-sm" name="var" placeholder="Account Code..." maxlength="10" value="{{ $data->var }}" readonly>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="" class="control-label">Status <span class="required">*</span></label>
												<select class="form-control input-sm" name="status" required>
													<option value="">Pilih Status...</option>
													<option @if( $data->status == 'active' ) selected="" @endif value="active">Aktif</option>
													<option @if( $data->status == 'not active' ) selected="" @endif value="not active">Tidak Aktif</option>
												</select>
											</div>

										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label for="">Keterangan</label>
												<textarea name="desc" class="form-control input-sm">{{ $data->desc }}</textarea>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<table style="table-layout: fixed;">
												@for ($i = 0; $i < $jmlRow; $i++) <tr>
													<td style="padding-right: 2%;padding-left: 2%;word-wrap: break-word; width: 33%">
														<div class="form-group">
															<div class="checkbox">
																<label>
																	<input type="checkbox" @if( $dataCoa1[$i]->checked == true ) checked="" @endif value="{{ $dataCoa1[$i]->code }}" class="ck {{ ( $dataCoa1[$i]->checked == true ) ? 'old-code-coa' : ' ' }}">
																	{{ ucfirst($dataCoa1[$i]->code) }} - {{ ucfirst($dataCoa1[$i]->desc) }}
																</label>
															</div>
														</div>
													</td>
													<td style="padding-right: 2%;padding-left: 2%;word-wrap: break-word; width: 33%">
														<div class="form-group">
															<div class="checkbox">
																<label>
																	<input type="checkbox" @if( $dataCoa2[$i]->checked == true ) checked="" @endif value="{{ $dataCoa2[$i]->code }}" class="ck {{ ( $dataCoa2[$i]->checked == true ) ? 'old-code-coa' : ' ' }}">
																	{{ ucfirst($dataCoa2[$i]->code) }} - {{ ucfirst($dataCoa2[$i]->desc) }}
																</label>
															</div>
														</div>
													</td>
													<td style="padding-right: 2%;padding-left: 2%;word-wrap: break-word; width: 33%">
														@if(!empty($dataCoa3[$i]))

														<div class="form-group">
															<div class="checkbox">
																<label>
																	<input type="checkbox" @if( $dataCoa3[$i]->checked == true ) checked="" @endif value="{{ $dataCoa3[$i]->code }}" class="ck {{ ( $dataCoa3[$i]->checked == true ) ? 'old-code-coa' : ' ' }}">
																	{{ ucfirst($dataCoa3[$i]->code) }} - {{ ucfirst($dataCoa3[$i]->desc) }}
																</label>
															</div>
														</div>
														@endif
													</td>
													</tr>
													@endfor
											</table>
										</div>
									</div>
								</div>
								<!-- /.box-body -->
								<div class="box-footer">
									<div class="pull-right">
										<a href="{{route('minteface.index')}}" class="btn btn-info">Kembali</a>
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
</div>
@stop
@section('js')
<script type="text/javascript">
	var coa = [];
	$(document).ready(function() {

		$('.select2').select2();

		//add-to-array-on load produk[]
		$('.old-code-coa').each(function(i, Obj) {
			coa.push($(this).val()); //get-value and push

			$('#usecoa').val(JSON.stringify(coa));
		});

		// alert($('#usecoa').val());

		$(document).on('change', '.ck', function() {
			if (this.checked) {

				coa.push($(this).val());
				// alert(coa);

			} else {
				var removeCoa = $(this).val();

				coa = jQuery.grep(coa, function(value) {
					return value != removeCoa;
				});

				// alert($('#usecoa').val());
			}

			$('#usecoa').val(JSON.stringify(coa));
		});
	});
</script>
@stop