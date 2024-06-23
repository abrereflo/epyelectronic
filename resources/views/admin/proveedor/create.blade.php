<form action="{{ route('proveedor.store') }}" method="POST" id="add-proveedor" enctype="multipart/form-data" autocomplete="off">
    @csrf
    <div class="modal fade text-left" id="ModalCreate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    @if ($errors)
                        @foreach ($errors as $error)
                            <ul>
                                <li> {{$error}}</li>
                            </ul>
                        @endforeach
                    @endif
                    <ul id='list_errors'>
                    </ul>
                    <div class="card">
                        <div class="card-header">
                           <h4 class="text-info text-uppercase">Proveedor</h4>
                        </div>
                        <div class="card-body">
                            <div class="contend">
                                <div class="row">
                                    <input type="hidden" name="titulo" value="{{ $content }}">
                                    <div class="col">
                                        <div class="form-group text-uppercase">
                                            <label for="name">Nombre <strong class="text-danger">*</strong></label>
                                            <input type="text" class="form-control text-uppercase" name="name" id="name" placeholder="Nombres">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group text-uppercase">
                                            <label for="last_name">Apellido <strong class="text-danger">*</strong></label>
                                            <input type="text" class="form-control text-uppercase" name="last_name" id="last_name"  placeholder="Apellidos">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col">
                                        <div class="form-group text-uppercase">
                                            <label for="phone">Celular <strong class="text-danger">*</strong></label>
                                            <input type="text" class="form-control text-uppercase" name="phone" id="phone"  placeholder="Celular">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group text-uppercase">
                                            <label for="phone_company">Celular Corporativo<strong class="text-danger">*</strong></label>
                                            <input type="text" class="form-control text-uppercase" name="phone_company" id="phone_company"  placeholder="Celular Corporativo">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col">
                                        <div class="form-group text-uppercase">
                                            <label for="direction">Dirección <strong class="text-danger">*</strong></label>
                                            <input type="text" class="form-control text-uppercase" id="direction" name="direction"  placeholder="B/ Calle/ #...">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group text-uppercase">
                                            <label for="email">Correo <strong class="text-danger">*</strong></label>
                                            <input type="email" class="form-control text-uppercase" id="email" name="email"  placeholder="Correo Electronico">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col">
                                        <div class="form-group text-uppercase">
                                            <label for="business_name">Razon Social</label>
                                            <input type="text" class="form-control text-uppercase" name="business_name" id="business_name" placeholder="Nombre de la empresa">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group text-uppercase">
                                            <label for="nit">N° Documento o NIT <strong class="text-danger">*</strong></label>
                                            <input type="text" class="form-control text-uppercase" name="nit" id="nit"  placeholder="Carnet de identidad">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group text-uppercase">
                                            <label for="type_supplier">Tipo de proveedor</label>
                                            <input type="text" class="form-control text-uppercase" name="type_supplier" id="type_supplier"  placeholder="Tipo de proveedor">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <button type="button" class="btn btn-danger text-uppercase" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-info text-uppercase">Registrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
