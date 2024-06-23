
<form action="{{ route('producttype.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade text-left" id="ModalCreate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header text-uppercase">
                            <h4 class="text-info">Nuevo Tipo de Producto</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group text-uppercase">
                                <label>Tipo Producto <strong class="text-danger">*</strong> </label>
                                <input type="text" name="name" id="" value="{{ old('name') }}" class="form-control text-uppercase" placeholder="Tipo de producto">
                            </div>
                            <div class="form-group text-uppercase">
                                <label>Descripción</label>
                                <textarea class="form-control text-uppercase" name="description" rows="3" value="{{ old('description') }}"
                                    placeholder="Descripción"></textarea>
                            </div>
                        </div>
                        <div class="card-footer text-muted text-uppercase">
                            <a class="btn btn-danger" href="{{ route('producttype.index') }}">Cancelar</a>
                            <button type="submit" class="btn btn-info">Registrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
