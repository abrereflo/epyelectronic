<div class="modal fade text-left" id="ModalCreate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('client.save_cliente') }}" method="POST" id="add-client" autocomplete="off"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    @if ($errors)
                        @foreach ($errors as $error)
                            <ul>
                                <li> {{ $error }}</li>
                            </ul>
                        @endforeach
                    @endif
                    <div class="card">
                        <ul id='list_errors'>
                        </ul>
                        <div class="card-header">
                            <h4 class="text-info text-uppercase">Cliente</h4>
                        </div>
                        <div class="card-body">
                            <div class="contend">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group text-uppercase">
                                            <label for="code">Codigo <strong class="text-danger">*</strong></label>
                                            <input type="text" class="form-control text-uppercase" name="code"
                                                id="code" value="{{ $code_cli }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group text-uppercase">
                                            <label for="name">Nombre <strong class="text-danger">*</strong></label>
                                            <input type="text" class="form-control text-uppercase" name="name"
                                                id="name" placeholder="Nombres">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group text-uppercase">
                                            <label for="lastname">Apellido <strong
                                                    class="text-danger">*</strong></label>
                                            <input type="text" class="form-control text-uppercase" name="lastname"
                                                id="lastname" placeholder="Apellidos">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group text-uppercase">
                                            <label for="ci">N° Documento <strong
                                                    class="text-danger">*</strong></label>
                                            <input type="text" class="form-control text-uppercase" name="ci"
                                                id="ci" placeholder="Carnet de identidad">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group text-uppercase">
                                            <label for="phone">Celular <strong class="text-danger">*</strong></label>
                                            <input type="text" class="form-control text-uppercase" name="phone"
                                                id="phone" placeholder="Celular">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group text-uppercase">
                                            <label for="city">Ciudad <strong class="text-danger">*</strong></label>
                                            <select
                                                class="custom-select form-control-border border-width-2 text-uppercase"
                                                name="city" id="city">
                                                @foreach ($ciudades as $ciudade)
                                                    <option value="{{ $ciudade }}">{{ $ciudade }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group text-uppercase">
                                            <label for="address">Dirección <strong
                                                    class="text-danger">*</strong></label>
                                            <input type="text" class="form-control text-uppercase" id="address"
                                                name="address" placeholder="B/ Calle/ #...">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group text-uppercase">
                                            <label for="email">Correo <strong class="text-danger">*</strong></label>
                                            <input type="email" class="form-control text-uppercase" id="email"
                                                name="email" placeholder="Correo Electronico">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group text-uppercase">
                                            <label for="business_name">Razon Social</label>
                                            <input type="text" class="form-control text-uppercase"
                                                name="business_name" id="business_name"
                                                placeholder="Nombre de la empresa">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group text-uppercase">
                                            <label for="nit">NIT</label>
                                            <input type="text" class="form-control text-uppercase" name="nit"
                                                id="nit" placeholder="NIT/# documento">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-info text-uppercase">Registrar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
