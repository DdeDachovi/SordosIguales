@extends('layout')
@section('title')Administrar colaborador
@endsection


@section('pre-body')
    @if ($errors->any())
        <!-- Errores de Validacion Modal -->
        <div class="modal fade" id="errorsModal" aria-label="Errores" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" >
                    <div class="modal-header"style="background-color: #FFAAAA">
                        <h5 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Por favor corregir los siguientes errores:</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary formButton" data-dismiss="modal">Entendido</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('content')
    <?php
    $id = Auth::user()->id;
    $rol = DB::table('users')->where('id', $id)->value('rol');
    if($rol == 'Alumno'){?>
    <meta http-equiv='refresh' content='0; URL=/usuarios/{{ $id }}/'>
    <?php }else { ?>

<br>
    <h1 class = "text-center">Editar colaborador</h1>
    <br />
    <br />
    <h3 class = "text-center">Colaborador actual:</h3>
    <div class ="container d-flex justify-content-center">
        <a href="{{$colaborador['url']}}" target="_blank"><img class = "img" src="{{$colaborador['logo']}}" style ="height: 150px; padding: 15px;" alt="{{$colaborador['nombre']}}" title="{{$colaborador['nombre']}}"></a>
    </div>

    <br />
    <br />
    <br />


    <div class="container containerForm">
        <form id="formColab" autocomplete="off" method="POST" action="{{route('colaboradores.update',$colaborador['id'])}} " enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="form-group row">
                <label for="inputVideo" class="col-sm-2 col-form-label">Nombre</label>
                <div class="col-sm-3">
                    <input class="form-control" style="background: #EEF2FC;" name="inputNombre" id="inputNombre" value="{{$colaborador['nombre']}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputVideo" class="col-sm-2 col-form-label">Direccion de pagina de colaborador (URL)</label>
                <div class="col-sm-3">
                    <input class="form-control" style="background: #EEF2FC;" name="inputURL" id="inputURL" value="{{$colaborador['url']}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPortada" class="col-sm-2 col-form-label">Logo colaborador </label>
                <div class="col-sm-3">
                    <input type="file" class="form-control file" style="background: #EEF2FC;" name="inputLogo" id="inputLogo">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">
                    <span class="border">
                        <button type="button" class="btn btn-secondary formButton"  data-toggle="modal" data-target="#confirmCancelModal"  role="button">Cancelar</button>
                    </span>
                </div>
                <div class="col-sm-2">
                    <span class="border">
                      <button type="button" class="btn btn-secondary formButton" data-toggle="modal" data-target="#confirmSubmitModal" >Confirmar</button>
                    </span>
                </div>
            </div>

            <!-- Cancel Modal -->
            <div class="modal fade" id="confirmCancelModal" tabindex="-1" role="dialog" aria-labelledby="confirmCancelModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmCancelModal">Confirmar cancelación</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ¿Desea cancelar el registro y volver al menú de registros?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Volver al formulario</button>
                            <a type="button" class="btn btn-primary" href="{{route('colaboradores.index')}}" role="button">Cancelar registro</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Confirmar Modal -->
            <div class="modal fade" id="confirmSubmitModal" tabindex="-1" role="dialog" aria-labelledby="confirmSubmitModal" aria-hidden="true">
                <div class="modal-dialog" role="document" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmSubmitModal">Confirmar envio</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ¿Está seguro que desea confirmar el registro?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Volver al formulario</button>
                            <button id ="submitButton" type="submit" class="btn btn-primary formButton">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>

    <script>
        $(document).ready(function() {
            var errors = {!! json_encode($errors->toArray()) !!};
            if (!Array.isArray(errors)) {
                $('#errorsModal').modal('show')
            }
        });
    </script>
    <?php } ?>
@endsection
