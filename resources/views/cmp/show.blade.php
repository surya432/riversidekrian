@extends('adminlte::page')

@section('title', 'CMP '.$data->name)

@section('content_header')
<h1 class="m-0 text-dark"></h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-12">
                        <div class="box box-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header" style="height: 300px;">
                                <h3 class="widget-user-username">{{$data->tipe}} {{ $data->kelurahan->name}} RT {{ $data->rt}} </h3>
                                <h5 class="widget-user-desc">Kecamatan {{ $data->kecamatan->name}} - {{ $data->kabupaten->name}}</h5>
                                <h5 class="widget-user-desc"> {{$data->provinsi->name}}</h5>
                            </div>
                            <!-- <div class="widget-user-image" style="padding-top:80px;">
                                    <img class="img-circle" src="{{ Avatar::create($data->name)->toBase64()}}" alt="User Avatar">
                            </div> -->
                            <div class="box-footer">
                                <div class="row">
                                    <!-- <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">3,200</h5>
                                    <span class="description-text">SALES</span>
                                </div> -->
                                    <!-- /.description-block -->
                                    <!-- </div> -->
                                    <!-- /.col -->
                                    <div class="col-sm-6 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">{{ $data->rumah->count()}}</h5>
                                            <span class="description-text">Rumah</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-6">
                                        <div class="description-block">
                                            <h5 class="description-header">{{$data->warga->count()}}</h5>
                                            <span class=" description-text">Warga</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h5 class="box-title">Warga Yang Bergabung</h5>
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