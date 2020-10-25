@extends('template.app')

@section('treeview_master','active')
@section('treeview_coa','active')

@section('headertitle','Chart Of Account')

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
@stop
@section('customscripts')
<script type="text/javascript" src="{{URL::asset('/plugins/select2.full.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('/js/datatables.bootstrap.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.select2').select2();
	});
</script>
@stop