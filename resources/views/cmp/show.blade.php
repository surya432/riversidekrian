@extends('adminlte::page')

@section('title', 'List CMP')

@section('content_header')
<h1 class="m-0 text-dark"></h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Infomasi RT</h3>
                        <div class="box-tools pull-right">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <!-- Here is a label for example -->
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <div class="box-body">
                        <div class='row'>
                            <div class="col-md-6">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Nama Perumahan / Desa</strong>
                                        {!! Form::text('name', $data->name, array('placeholder' => 'Name Videos','class' => 'form-control','readonly'=>true) ) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Provinsi Perumahan / Desa</strong>
                                        {!! Form::text('name', $data->provinsi->name, array('placeholder' => 'Name Videos','class' => 'form-control','readonly'=>true) ) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Kabupaten Perumahan / Desa</strong>
                                        {!! Form::text('name', $data->kabupaten->name, array('placeholder' => 'Name Videos','class' => 'form-control','readonly'=>true) ) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Kecamatan Perumahan / Desa</strong>
                                        {!! Form::text('name', $data->kecamatan->name, array('placeholder' => 'Name Videos','class' => 'form-control','readonly'=>true) ) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Kelurahan Perumahan / Desa</strong>
                                        {!! Form::text('name', $data->kelurahan->name, array('placeholder' => 'Name Videos','class' => 'form-control','readonly'=>true) ) !!}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Warga Yang Bergabung</h3>

                        <div class="box-tools text-right">
                            <span class="label label-danger">{{$data->warga->count()}} Warga</span>

                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <ul class="users-list clearfix">
                            @foreach($data->warga as $a=>$person)
                            <li>
                                <img src="{{Gravatar::get($person->email)}}" alt="User Image">
                                <a class="users-list-name" href="#">{{$person->name}}</a>
                                <span class="users-list-date">{{$person->email}}</span>
                            </li>
                            @endforeach
                        </ul>
                        <!-- /.users-list -->
                    </div>
                    <!-- /.box-body -->
                    <!-- <div class="box-footer text-center">
                        <a href="javascript:void(0)" class="uppercase">View All Users</a>
                    </div> -->
                    <!-- /.box-footer -->
                </div>
            </div>
            <div class="modal" id="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                    </div>
                </div>
            </div>
        </div>
    </div>
    @stop
    @section('js')
    <script type="text/javascript">
        $(document).ready(function() {

        });
    </script>
    @stop