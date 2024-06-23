
<form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade text-left" id="ModalCreate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header text-info text-uppercase">
                        <h4><strong> Nuevo Producto</strong></h4>
                    </div>
                    <div class="card-body">
                        <div class="row text-uppercase">
                            <div class="col">
                                <div class="form-group text-uppercase">
                                    <label for="product_types_id">Tipo</label>
                                    <select class="custom-select form-control-border text-uppercase"
                                        id="product_types_id" name="product_types_id">
                                        <option value="" style="display:none">Seleccione</option>
                                        @foreach ($typeproductos as $typeproducto)
                                            @if ($typeproducto->statu)
                                                <option value="{{ $typeproducto->id }}">
                                                    {{ $typeproducto->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group text-uppercase">
                                    <label for="product_families_id">Marca</label>
                                    <select class="custom-select form-control-border text-uppercase"
                                        id="product_families_id" name="product_families_id">
                                        <option value="" style="display:none">Selecione</option>
                                        @foreach ($marcas as $marca)
                                            @if ($marca->statu)
                                                <option value="{{ $marca->id }}">
                                                    {{ $marca->name }}</option>
                                            @endif
                                        @endforeach
                                    @endforeac
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Codigo</label>
                                    <input type="text" class="form-control text-uppercase" name="code" id="code" placeholder="Codigo de Producto">
                                </div>
                            </div>

                        </div>

                        <div class="row text-uppercase">
                            <div class="col">
                                <div class="form-group">
                                    <label>Producto</label>
                                    <input type="text" class="form-control text-uppercase" name="name" id="name" placeholder="Nombre Producto ...">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Precio De Venta</label>
                                    <input type="text" class="form-control text-uppercase somente-numero" name="price" id="price" placeholder="Precio de Venta ...">
                                </div>
                            </div>
                        </div>

                        <div class="row text-uppercase">
                            <div class="col">
                                <div class="form-group">
                                    <label>Alerta Cantidad</label>
                                    <input type="text" class="form-control text-uppercase somente-numero" name="alert_quantity" id="alert_quantity" placeholder="Precio Facturado ...">
                                </div>
                            </div>
                            <div class="col">
                                <label>Stock</label>
                                <input type="text" class="form-control text-uppercase" name="stock" id="stock" Value="0" readonly placeholder="Precio Facturado ...">
                            </div>
                            <div class="col">
                            </div>
                        </div>
                        <div class="row text-uppercase">
                            <div class="col">
                                <label>Seleccione Imagen</label>
                                <div class="btn-container">
                                    <input  name="image" id="image" type="file" class="text-primary text-uppercase" accept=".jpg, .jpeg, .png">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <img src="./img/80x80.png" id="preview"  class="img-thumbnail">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group text-uppercase">
                            <label>Descripción</label>
                            <textarea class="form-control text-uppercase" rows="3" name="description" id="description"
                                placeholder="Descripción del Producto ..."></textarea>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-uppercase">
                        <a class="btn btn-danger" href="{{ route('product.index') }}">Cancelar</a>
                        <button type="submit" class="btn btn-info text-uppercase">Registrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
