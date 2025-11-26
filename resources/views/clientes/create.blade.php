@extends('layouts.layout_main')

@section('title', 'Crear Cliente')

@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Crear Cliente</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Clientes</a></li>
                        <li class="breadcrumb-item active">Crear Cliente</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <form id="createclient-form" autocomplete="off" class="needs-validation" novalidate action="{{ route('clientes.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Información Personal</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="tipo_documento">Tipo de Documento</label>
                                    <select class="form-select" id="tipo_documento" name="tipo_documento" required>
                                        <option value="">Seleccionar tipo</option>
                                        <option value="DNI">DNI</option>
                                        <option value="RUC">RUC</option>
                                        <option value="CE">Carnet de Extranjería</option>
                                        <option value="PASAPORTE">Pasaporte</option>
                                    </select>
                                    <div class="invalid-feedback">Por favor seleccione un tipo de documento.</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="numero_documento">Número de Documento</label>
                                    <input type="text" class="form-control" id="numero_documento" name="numero_documento" placeholder="Ingrese número de documento" required>
                                    <div class="invalid-feedback">Por favor ingrese el número de documento.</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="nombres">Nombres</label>
                                    <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Ingrese nombres" required>
                                    <div class="invalid-feedback">Por favor ingrese los nombres.</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="apellido_paterno">Apellido Paterno</label>
                                    <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" placeholder="Ingrese apellido paterno" required>
                                    <div class="invalid-feedback">Por favor ingrese el apellido paterno.</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="apellido_materno">Apellido Materno</label>
                                    <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" placeholder="Ingrese apellido materno" required>
                                    <div class="invalid-feedback">Por favor ingrese el apellido materno.</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="fecha_nacimiento">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="telefono">Teléfono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ingrese teléfono">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese email">
                                </div>
                            </div>
                            <!-- Campo estado oculto con valor por defecto -->
                            <div class="col-lg-6 d-none">
                                <div class="mb-3">
                                    <label class="form-label" for="estado">Estado</label>
                                    <select class="form-select" id="estado" name="estado" required>
                                        <option value="ACTIVO" selected>ACTIVO</option>
                                        <option value="INACTIVO">INACTIVO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="direccion">Dirección</label>
                            <textarea class="form-control" id="direccion" name="direccion" placeholder="Ingrese dirección" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Acciones</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="fecha_registro" class="form-label">Fecha de Registro</label>
                            <input type="datetime-local" class="form-control" id="fecha_registro" name="fecha_registro" readonly>
                        </div>
                        
                        <!-- Botones alineados horizontalmente -->
                        <div class="d-flex gap-2 justify-content-end">
                            <button type="submit" class="btn btn-success w-50">Guardar Cliente</button>
                            <a href="{{ route('clientes.index') }}" class="btn btn-secondary w-50">Cancelar</a>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Información Adicional</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Estado del Cliente</label>
                            <p class="text-muted">
                                <span class="badge bg-success">ACTIVO</span> - El cliente se creará en estado ACTIVO
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha de Creación</label>
                            <p class="text-muted">Se registrará automáticamente al guardar</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha de Actualización</label>
                            <p class="text-muted">Se actualizará automáticamente al modificar</p>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </form>
</div>

<script>
    // Establecer la fecha y hora actual en el campo de fecha de registro
    document.addEventListener('DOMContentLoaded', function() {
        const now = new Date();
        // Formatear para input datetime-local (YYYY-MM-DDTHH:MM)
        const formatted = now.toISOString().slice(0, 16);
        document.getElementById('fecha_registro').value = formatted;
    });
</script>
@endsection