@extends('layouts.default')
@section('titulo_pagina','Mascotas | Perfil')
@section('titulo','Mascotas')
@section('subtitulo','Perfil de usuario')
@section('contenido')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Perfil de usuario</h3>
            </div>
            <div class="box-body">
                @if(Session::has('exito'))
                    <div class="alert alert-success alert-dismissible" style="margin-top: 20px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Éxito!</h4>
                        {{ Session::get('exito') }}
                    </div>
                @endif
                @if(Session::has('error'))
                    <div class="alert alert-danger alert-dismissible" style="margin-top: 20px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-ban"></i> Error!</h4>
                        {{Session::get('error')}}
                    </div>
                @endif
                <form method="POST" id="frmActualizarPerfil"
                    action="{{route('perfil.update',$usuario->id)}}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Nombre</label>
                        <input name="nombre" type="text" class="form-control" value="{{$usuario->name}}">
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="text" class="form-control" value="{{$usuario->email}}" readonly>
                    </div>
                    <div class="form-group grupo-password">
                        <label>Contraseña</label>
                        <input name="password" type="password" class="form-control" id="txtContrasena">
                    </div>
                    <div class="form-group grupo-password">
                        <label>Confirmar contraseña</label>
                        <input type="password" class="form-control" id="txtConfirmarContrasena">
                        <span class="help-block" id="spnMensajeContrasenaNoCoincide">Contraseñas no coinciden</span>
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input name="foto" type="file" class="form-control">
                    </div>
                    <div class="form-group">
                        @if($usuario->foto)
                        <img src="/storage/{{$usuario->foto}}" 
                            class="img-responsive"
                            style="width:200px; height:auto;"/>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="button" id="btnActualizar" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function doClickActualizar(event) {
        if($("#txtContrasena").val() == $("#txtConfirmarContrasena").val() ) {
            //Envío el formulario
            $("#frmActualizarPerfil").submit();
        } else {
            //Muestro errores
            $("#spnMensajeContrasenaNoCoincide").show();
            $(".grupo-password").addClass('has-error');
        }
    }

    function doChangeContrasena(e) {
        $(".grupo-password").removeClass('has-error');
        $("#spnMensajeContrasenaNoCoincide").hide();
    }

    $(function () {
        $("#spnMensajeContrasenaNoCoincide").hide();
        $("#btnActualizar").click(doClickActualizar);
        $("#txtContrasena").change(doChangeContrasena);
        $("#txtConfirmarContrasena").change(doChangeContrasena);
    });
</script>
@endsection