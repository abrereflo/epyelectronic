@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')

@stop

@section('content')
    <form action="{{ route('product.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header text-info text-uppercase">
                <h4><strong> Editar Familia de Producto</strong></h4>
            </div>
            <div class="card-body">
                <div class="row text-uppercase">
                    <div class="col">
                        <div class="form-group text-uppercase">
                            <label for="tipoproducto_id">Tipo de Producto</label>
                            <select class="custom-select form-control-border text-uppercase" id="tipoproducto_id"
                                name="tipoproducto_id">
                                @foreach ($typeproductos as $typeproducto)
                                    @if ($typeproducto->statu)
                                        <option value="{{ $typeproducto->id }}"
                                            {{ $producto->productfamily->productstype->id == $typeproducto->id ? 'selected' : '' }}>
                                            {{ $typeproducto->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group text-uppercase">
                            <label for="product_families_id">Familia de Producto</label>
                            <select class="custom-select form-control-border text-uppercase" id="product_families_id"
                                name="product_families_id">
                                <option value="{{ $producto->product_families_id }}"> {{ $producto->productfamily->name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Codigo</label>
                            <input type="text" class="form-control text-uppercase" name="code" id="code"
                                placeholder="Codigo de Producto" value="{{ $producto->code }}">
                        </div>
                    </div>

                </div>

                <div class="row text-uppercase">
                    <div class="col">
                        <div class="form-group">
                            <label>Producto</label>
                            <input type="text" class="form-control text-uppercase" name="name" id="name"
                                placeholder="Nombre Producto ..." value="{{ $producto->name }}">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label>Precio De Venta</label>
                            <input type="text" class="form-control text-uppercase" name="salePrice" id="salePrice"
                                placeholder="Precio de Venta ..." value="{{ $producto->salePrice }}">
                        </div>
                    </div>
                </div>

                <div class="row text-uppercase">
                    <div class="col">
                        <div class="form-group">
                            <label>Precio Facturado</label>
                            <input type="text" class="form-control text-uppercase" name="invoicePrice" id="invoicePrice"
                                placeholder="Precio Facturado ..." value="{{ $producto->invoicePrice }}">
                        </div>
                    </div>
                    <div class="col">
                        <label>Cantidad</label>
                        <input type="text" class="form-control text-uppercase" name="stock" id="stock"
                            Value="0" readonly placeholder="Precio Facturado ..." value="{{ $producto->stock }}">
                    </div>
                    <div class="col">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Seleccione Imagen</label>
                        <div class="btn-container">
                            <input name="image" id="image" type="file" class="text-primary"
                                accept=".jpg, .jpeg, .png">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {{-- <img src="./img/80x80.png" id="preview" class="img-thumbnail"> --}}
                            <img src="{{ Storage::url($producto->image) }}" id="preview" height="200" width="200"
                                alt="" />
                        </div>
                    </div>
                </div>

                <div class="form-group text-uppercase">
                    <label>Descripción</label>
                    <textarea class="form-control text-uppercase" rows="3" name="description" id="description"
                        placeholder="Descripción del Producto ...">{{ $producto->description }}</textarea>
                </div>
            </div>
            <div class="card-footer text-muted text-uppercase">
                <a class="btn btn-danger" href="{{ route('product.index') }}">Cancelar</a>
                <button type="submit" class="btn btn-info text-uppercase">Registrar</button>
            </div>
        </div>
    </form>


   {{--  <div class="card ">
        <div class="card-header">
            <h1>EDITAR PRODUCTO</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('product.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="contend">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="m-2">Familia de Producto</label>
                                <select id="product_families_id" name="product_families_id" class="custom-select">
                                    {{-- @foreach ($familiaproductos as $familiaproducto)
                                        <option value="{{ $familiaproducto->id }}"
                                            {{ $producto->product_families_id == $familiaproducto->id ? 'selected' : '' }}>
                                            {{ $familiaproducto->name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                            <div class="form-group">
                                {{-- <label class="m-2">Codigo</label>
                                <input type="text" name="code" id="code" value="{{ $producto->code }}"> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="m-2">Producto</label>
                                <input type="text" name="name" id="name" value="{{ $producto->name }}">
                            </div>
                            <div class="form-group">
                                <label class="m-2">Costo</label>
                                <input type="text" name="cost" id="cost" value="{{ $producto->cost }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="m-2">Costo Venta</label>
                                <input type="text" name="salePrice" id="salePrice"
                                    value="{{ $producto->salePrice }}">
                            </div>
                            <div class="form-group">
                                <label class="m-2">Costo Facturado</label>
                                <input type="text" name="invoicePrice" id="invoicePrice"
                                    value="{{ $producto->invoicePrice }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="m-2">description</label>
                        <input type="text" name="description" id="description"
                            value="{{ $producto->description }}">
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="m-2">Stock</label>
                                <input type="text" name="stock" id="stock" value="{{ $producto->stock }}">
                            </div>
                            <div class="form-group">
                                <!-- <label for="customFile">Custom File</label> -->

                                <div class="custom-file">
                                    <input type="file" name="image" accept="image/png, image/jpeg" />
                                </div>
                                <div class="form-group">
                                    <img src="{{ Storage::url($producto->image) }}" height="200" width="200"
                                        alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-danger" href="{{ route('product.index') }}">Cancelar</a>
                        <button type="submit" class="btn btn-info">Registrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script>
        $(document).on("click", ".browse", function() {
            var file = $(this)
                .parent()
                .parent()
                .parent()
                .find(".file");
            file.trigger("click");
        });
        $('input[type="file"]').change(function(e) {
            var fileName = e.target.files[0].name;
            $("#file").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                document.getElementById("preview").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });
    </script>
    <script>
        //Select dinamico tipo producto a familia producto
        $(document).ready(function() {
            $('select[name="tipoproducto_id"]').on('change', function() {
                var tipoproducto_id = $(this).val();
                if (tipoproducto_id) {
                    $.ajax({
                        url: "{{ url('/admin/producto/familia') }}/" + tipoproducto_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $("#product_families_id").empty();
                            $("#product_families_id").append('<option value="' + 0 +
                                '" selected disabled>' + 'Seleccione Familia' + '</option>')
                            $.each(data, function(key, value) {
                                $("#product_families_id").append('<option value="' +
                                    value.id + '">' + value.name +
                                    '</option>')
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>
@stop
