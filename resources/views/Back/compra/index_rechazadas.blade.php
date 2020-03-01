@extends('Back.master')
@section('title', __('idioma.compra_apro_titu'))
@section('active-compras', 'active subdrop')
@section('active-compras-rechazadas', 'active')
@section('content')
<!--CONSULTA DE PERMISOS SEGUN EL ROL-->
<?php $permisos = \DB::table('permisos')->where('rol_id', Session::get("rol_id"))->first();?>
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">@lang('idioma.compra_rech_titu')</h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li>
                                <a href="{{ url('/dash') }}">{{$sistema->nombre_empresa}}</a>
                            </li>
                            <li class="active">
                                @lang('idioma.compra_rech_titu')
                            </li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->
       
            <div class="row">
                <div class="col-sm-12">
                
                    <div class="card-box table-responsive">

                        @if(Session::get("rol_id"))
                            <h3 class="box-title"><a href="{{url('/pdf_compras_rechazadas')}}" class="btn btn-danger pull-right"><i class="fa fa-file-pdf-o"></i>{{" PDF "}}</a></h3>
                            <h3 class="box-title"><a href="{{url('/csv_compras_rechazadas')}}" class="btn btn-success pull-right"><i class="fa fa-file-excel-o"></i>{{" CSV "}}</a></h3>
                        @endif

                        <h4 class="m-t-0 header-title"><b>@lang('idioma.compra_rech_list')</b></h4>
                        <p class="text-muted font-13 m-b-30">
                            &nbsp;
                        </p>
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{session('status')}}
                                </div>
                            @endif
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>{{"#"}}</th>
                                <th>@lang('idioma.gral_codigo') @lang('idioma.gral_compra')</th>
                                <th>@lang('idioma.gral_provee')</th>
                                <th>{{"Total ".$sistema->moneda}}</th>
                                <th>@lang('idioma.dash_fecha')</th>
                                <th>@lang('idioma.gral_motivo')</th>
                                <th>@lang('idioma.gral_opcions')</th>
                            </tr>
                            </thead>


                            <tbody>
                            @foreach($datos as $key => $d)
                                <tr>
                                   <td>{{++$key}}</td>
                                   <td class="fac_rechazadas">{{ $d->codigo_proceso }}</td>
                                   <td>{{ $d->cliente->cedula }}</td>
                                   <td>{{ number_format($d->total,2) }}</td>
                                   <td>{{ $d->created_at }}</td>
                                   <td>{{ $d->motivo_rechazo }}</td>
                                   <td><a title="@lang('idioma.gral_descargar')" href="{{url('/pdf_compras_factura',$d->id)}}" class="btn btn-primary"><i class="fa fa-file"></i></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- container -->
    </div> <!-- content -->
@endsection