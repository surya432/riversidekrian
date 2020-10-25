@extends('template.app')

@section('treeview_accounting','active')
@section('treeview_saldo_awal','active')
@section('treeview_sa_coa','active')

@section('headertitle','Buat Saldo Awal COA')

@section('customcss')
<link rel="stylesheet" href="{{URL::asset('plugins/select2.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/bootstrap-datepicker.min.css')}}">
<link href="{{asset('css/select2-bootstrap.min.css')}}" rel="stylesheet" />
<link href="{{asset('css/bootstrap-datepicker.min.css')}}" rel="stylesheet" />
<link href="{{asset('plugins/bootstrap-timepicker.min.css')}}" rel="stylesheet" />
<link href="{{asset('plugins/daterangepicker.css')}}" rel="stylesheet" />
<style>
    .required {
        font-size: 12px;
        color: red;
    }
</style>
@stop

@section('content')
<div class="row">
    <div class="col-md-10" style="max-width:500px">
        <div class="box box-info">
            {{-- <div class="box-header with-border">
                <h3 class="box-title">Saldo Awal COA</h3>
            </div> --}}
            <form class="form-horizontal" action="{{url('admin/accounting/saldo-awal-coa-store')}}" method="post" id="formLaporan">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            {{ method_field('post') }}
                <div class="box-body" style="margin-left: 30px;">
                    @include('admin.displayerror')
                    <div class="row">
                        <div class="col-md-11">
                            <div class="form-group">
                                <label for="" class="control-label">Akun <span class="required">*</span></label>
                                <select class="select2 form-control" name="akun" id="akun" style="width: 100%;" required>
                                    <option selected value="">Pilih Akun...</option>
                                    @foreach($data as $raw_data)
                                        <option value="{{ $raw_data->id }}">{{ $raw_data->code }} - {{ $raw_data->desc }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                             <div class="form-group">
                                <label for="" class="control-label">Total <span class="required">*</span></label>
                                <input type="text" class="form-control input-sm " name="total" id="total" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required> </input>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                             <div class="form-group">
                                <label for="" class="control-label">Keterangan</label>
                                <textarea name="keterangan" class="form-control input-sm"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer" style="margin-right: 25px">
                    <div class="pull-right">
                        <a href="{{ url('admin/accounting/saldo-awal-coa') }}" class="btn btn-info">Kembali</a>
                        <button type="reset" class="btn btn-danger" id="reset">Batal</button>
                        <button  type="submit" class="btn btn-success">Posting</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('customscripts')
    <script type="text/javascript" src="{{URL::asset('/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/js/datatables.bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/plugins/select2.full.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/plugins/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/plugins/daterangepicker.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/plugins/bootstrap-timepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/plugins/autoNumeric.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.select2').select2();

            new AutoNumeric('#total', { 
                currencySymbol      : '',
                digitGroupSeparator : '.',
                decimalCharacter    : ',',
                decimalPlaces       : 0,
                minimumValue        : 0,
            });

            $('#periode').daterangepicker({
                locale: {
                  format: 'DD-MM-YYYY'
                },
            });
        });
    </script>
@stop
