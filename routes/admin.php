<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\ClaimsController;
use App\Http\Controllers\admin\ProducFamiliesController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductTypeController;
use App\Http\Controllers\admin\ClientController;
use App\Http\Controllers\admin\InventorieController;
use App\Http\Controllers\admin\QuoteController;
use App\Http\Controllers\admin\OrdersController;
use App\Http\Controllers\admin\StoreController;
use App\Http\Controllers\admin\DeliverieController;
use App\Http\Controllers\admin\DispatchesController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\WarrantiesController;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\BitacoraController;
use App\Http\Controllers\admin\ProviderController;

Route::get('/', [HomeController::class, 'index'])->name('home');

//Tipo de Productos
Route::get('/tipo_producto', [ProductTypeController::class, 'index'])->name('producttype.index');
Route::get('/tipo_producto/create', [ProductTypeController::class, 'create'])->name('producttype.create');
Route::post('/tipo_producto/store', [ProductTypeController::class, 'store'])->name('producttype.store');
Route::get('/tipo_producto/edit/{id}', [ProductTypeController::class,'edit'])->name('producttype.edit');
Route::put('/tipo_producto/{id}',  [ProductTypeController::class,'update'])->name('producttype.update');
Route::delete('/tipo_producto/{id}', [ProductTypeController::class, 'destroy'])->name('producttype.delete');
Route::get('/tipo_producto/show/{id}', [ProductTypeController::class, 'show'])->name('producttype.show');
Route::get('/tipo_producto/estado', [ProductTypeController::class,'UpdateStatusTipoProducto'])->name('UpdateStatusTipoProducto');
Route::post('/tipo_producto/buscar',[ProductTypeController::class, 'buscar'])->name('producttype.buscar');


//familia de Productos
Route::get('/familia_producto', [ProducFamiliesController::class, 'index'])->name('productfamily.index');
Route::get('/familia_producto/create', [ProducFamiliesController::class, 'create'])->name('productfamily.create');
Route::post('/familia_producto/store', [ProducFamiliesController::class, 'store'])->name('productfamily.store');
Route::get('/familia_producto/edit/{id}', [ProducFamiliesController::class,'edit'])->name('productfamily.edit');
Route::put('/familia_producto/{id}',  [ProducFamiliesController::class,'update'])->name('productfamily.update');
Route::delete('/familia_producto/{id}', [ProducFamiliesController::class, 'destroy'])->name('productfamily.delete');
Route::get('/familia_producto/show/{id}', [ProducFamiliesController::class, 'show'])->name('productfamily.show');
Route::get('/familia_producto/estado', [ProducFamiliesController::class,'UpdateStatusFamiliaProducto'])->name('UpdateStatusFamiliaProducto');
Route::post('/familia_producto/buscar',[ProducFamiliesController::class, 'buscar'])->name('productfamily.buscar');

//Productos
Route::get('/producto', [ProductController::class, 'index'])->name('product.index');
Route::get('/producto/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/producto/store', [ProductController::class, 'store'])->name('product.store');
Route::get('/producto/edit/{id}', [ProductController::class,'edit'])->name('product.edit');
Route::put('/producto/{id}',  [ProductController::class,'update'])->name('product.update');
Route::delete('/producto/{id}', [ProductController::class, 'destroy'])->name('product.delete');
Route::get('/producto/show/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/producto/estado', [ProductController::class,'UpdateStatusProducto'])->name('UpdateStatusProducto');
Route::post('/producto/buscar',[ProductController::class, 'buscar'])->name('product.buscar');
Route::get('/producto/familia/{id}', [ProductController::class, 'familia'])->name('product.familia');
Route::get('/producto/search', [ProductController::class, 'search'])->name('product.search');
Route::get('/producto/list/{id}', [ProductController::class, 'list'])->name('product.list');
//Almacen
Route::get('/almacen', [ StoreController::class, 'index'])->name('store.index');
Route::get('/almacen/create', [StoreController::class, 'create'])->name('store.create');
Route::post('/almacen/store', [StoreController::class, 'store'])->name('store.store');
Route::get('/almacen/edit/{id}', [StoreController::class,'edit'])->name('store.edit');
Route::put('/almacen/{id}',  [StoreController::class,'update'])->name('store.update');

//Inventario
Route::get('/inventario', [InventorieController::class, 'index'])->name('inventories.index');

Route::get('/inventarios', [InventorieController::class, 'inventario'])->name('inventories.inventario');

Route::get('/inventario/create', [InventorieController::class, 'create'])->name('inventories.create');
Route::post('/inventario/store', [InventorieController::class, 'store'])->name('inventories.store');
Route::get('/inventario/edit/{id}', [InventorieController::class,'edit'])->name('inventories.edit');
Route::put('/inventario/{id}',  [InventorieController::class,'update'])->name('inventories.update');
Route::get('/inventario/listar/{id}', [ InventorieController::class, 'list_product'])->name('inventories.product');
Route::any('/inventario/buscar', [InventorieController::class, 'buscar'])->name('inventories.buscar');
Route::get('/inventario/show/{id}', [InventorieController::class, 'show'])->name('inventories.show');
Route::delete('/inventario/{id}', [InventorieController::class, 'destroy'])->name('inventories.delete');
Route::get('/inventario/estado', [InventorieController::class,'UpdateStatusInventario'])->name('UpdateStatusInventario');

//Proveedores
Route::get('/proveedor', [ProviderController::class, 'index'])->name('proveedor.index');
Route::get('/proveedor/create', [ProviderController::class, 'create'])->name('proveedor.create');
Route::post('/proveedor/store', [ProviderController::class, 'store'])->name('proveedor.store');
Route::post('/proveedor/save_proveedores', [ProviderController::class, 'save_proveedores'])->name('proveedor.save_proveedores');
Route::get('/proveedor/edit/{id}', [ProviderController::class,'edit'])->name('proveedor.edit');
Route::put('/proveedor/{id}',  [ProviderController::class,'update'])->name('proveedor.update');
Route::delete('/proveedor/{id}', [ProviderController::class, 'destroy'])->name('proveedor.delete');
Route::get('/proveedor/show/{id}', [ProviderController::class, 'show'])->name('proveedor.show');
Route::get('/proveedor/estado', [ProviderController::class,'UpdateStatusproveedores'])->name('UpdateStatusproveedor');
Route::post('/proveedor/buscar',[ProviderController::class, 'buscar'])->name('proveedor.buscar');
Route::get('/proveedor/list/{id}', [ProviderController::class, 'list'])->name('proveedor.list');
Route::get('/reporte/proveedor', [ProviderController::class, 'reporte'])->name('proveedor.report');
Route::get('/proveedor/search', [ProviderController::class, 'search'])->name('proveedor.search');

//Clientes
Route::get('/cliente', [ClientController::class, 'index'])->name('client.index');
Route::get('/cliente/create', [ClientController::class, 'create'])->name('client.create');
Route::post('/cliente/store', [ClientController::class, 'store'])->name('client.store');
Route::post('/cliente/save_cliente', [ClientController::class, 'save_cliente'])->name('client.save_cliente');
Route::get('/cliente/edit/{id}', [ClientController::class,'edit'])->name('client.edit');
Route::put('/cliente/{id}',  [ClientController::class,'update'])->name('client.update');
Route::delete('/cliente/{id}', [ClientController::class, 'destroy'])->name('client.delete');
Route::get('/cliente/show/{id}', [ClientController::class, 'show'])->name('client.show');
Route::get('/cliente/estado', [ClientController::class,'UpdateStatusclientes'])->name('UpdateStatusclient');
Route::post('/cliente/buscar',[ClientController::class, 'buscar'])->name('client.buscar');
Route::get('/cliente/search', [ClientController::class, 'search'])->name('client.search');
Route::get('/cliente/list/{id}', [ClientController::class, 'list'])->name('client.list');
Route::get('/reporte/frecuente', [ClientController::class, 'reporte'])->name('client.report');

//Cotizaciones
Route::get('/cotizacion', [QuoteController::class, 'index'])->name('quote.index');
Route::get('/cotizacion/create', [QuoteController::class, 'create'])->name('quote.create');
Route::get('/cotizacion/show/{id}', [QuoteController::class, 'show'])->name('quote.show');
Route::post('/cotizacion/store', [QuoteController::class, 'store'])->name('quote.store');
Route::get('/cotizacion/edit/{id}', [QuoteController::class,'edit'])->name('quote.edit');
Route::put('/cotizacion/{id}',  [QuoteController::class,'update'])->name('quote.update');
Route::delete('/cotizacion/{id}', [QuoteController::class, 'destroy'])->name('quote.delete');
Route::get('/cotizacion/estado', [QuoteController::class,'UpdateStatusCotizacion'])->name('UpdateStatusquote');
Route::post('/cotizacion/buscar',[QuoteController::class, 'buscar'])->name('quote.buscar');
Route::get('/cotizacion/bcliente', [QuoteController::class, 'buscar_client'])->name('quote.bcliente');
Route::get('/cotizacion/bproduct', [QuoteController::class, 'buscar_product'])->name('quote.bproduct');
Route::get('/cotizacion/table', [QuoteController::class, 'gettable'])->name('quote.gettable');
Route::get('/cotizacion/impreso/{id}', [QuoteController::class, 'print'])->name('quote.print');
//Dirreciones para combox
Route::get('/cotizacion/fprod/{id}', [QuoteController::class, 'familipro'])->name('quote.fprod');
Route::get('/cotizacion/produc/{id}', [QuoteController::class, 'product'])->name('quote.product');
Route::get('/cotizacion/precios/{id}', [QuoteController::class, 'precios'])->name('quote.precios');

//Pedidos
Route::get('/pedido', [OrdersController::class, 'index'])->name('orders.index');
Route::get('/pedido/create', [OrdersController::class, 'create'])->name('orders.create');
Route::post('/pedido/store', [OrdersController::class, 'store'])->name('orders.store');
Route::get('/pedido/edit/{id}', [OrdersController::class,'edit'])->name('orders.edit');
Route::put('/pedido/{id}',  [OrdersController::class,'update'])->name('orders.update');
Route::delete('/pedido/{id}', [OrdersController::class, 'destroy'])->name('orders.delete');
Route::get('/pedido/show/{id}', [OrdersController::class, 'show'])->name('orders.show');
Route::get('/pedido/estado', [updateStatusOrdes::class,'updateStatusordes'])->name('updateStatusordes');
Route::post('/pedido/buscar',[OrdersController::class, 'buscar'])->name('orders.buscar');
Route::get('/pedido/client', [OrdersController::class, 'bclient'])->name('orders.bclient');
Route::get('/pedido/detalle', [OrdersController::class, 'detalle'])->name('orders.detalle');

Route::get('/reporte/cotizaciondespacho', [OrdersController::class, 'reporte'])->name('orders.report');

//Entregas
Route::get('/entregas', [DeliverieController::class, 'index'])->name('entregas.index');
Route::get('/entregas/create', [DeliverieController::class, 'create'])->name('entregas.create');
Route::post('/entregas/store', [DeliverieController::class, 'store'])->name('entregas.store');
Route::get('/entregas/edit/{id}', [DeliverieController::class,'edit'])->name('entregas.edit');
Route::put('/entregas/{id}',  [DeliverieController::class,'update'])->name('entregas.update');
Route::delete('/entregas/{id}', [DeliverieController::class, 'destroy'])->name('entregas.delete');
Route::get('/entregas/show/{id}', [DeliverieController::class, 'show'])->name('entregas.show');
Route::get('/entregas/buscar',[DeliverieController::class, 'search'])->name('entregas.buscar');
Route::get('/entregas/pedido', [DeliverieController::class, 'pedido'])->name('entregas.pedido');

//Despachos
Route::get('/despachos', [DispatchesController::class, 'index'])->name('despachos.index');
Route::get('/despachos/create', [DispatchesController::class, 'create'])->name('despachos.create');
Route::post('/despachos/store', [DispatchesController::class, 'store'])->name('despachos.store');
Route::get('/despachos/edit/{id}', [DispatchesController::class,'edit'])->name('despachos.edit');
Route::put('/despachos/{id}',  [DispatchesController::class,'update'])->name('despachos.update');
Route::delete('/despachos/{id}', [DispatchesController::class, 'destroy'])->name('despachos.delete');
Route::get('/despachos/show/{id}', [DispatchesController::class, 'show'])->name('despachos.show');
Route::get('/despachos/buscar',[DispatchesController::class, 'search'])->name('despachos.buscar');
Route::get('/despachos/pedido', [DispatchesController::class, 'pedido'])->name('despachos.pedido');

Route::get('/reporte/entregasdespachos', [DispatchesController::class, 'reporte'])->name('despachos.report');


//reclamos
Route::get('/reclamos', [ClaimsController::class, 'index'])->name('reclamos.index');
Route::get('/reclamos/create', [ClaimsController::class, 'create'])->name('reclamos.create');
Route::post('/reclamos/store', [ClaimsController::class, 'store'])->name('reclamos.store');
Route::get('/reclamos/edit/{id}', [ClaimsController::class,'edit'])->name('reclamos.edit');
Route::put('/reclamos/{id}',  [ClaimsController::class,'update'])->name('reclamos.update');
Route::delete('/reclamos/{id}', [ClaimsController::class, 'destroy'])->name('reclamos.delete');
Route::get('/reclamos/show/{id}', [ClaimsController::class, 'show'])->name('reclamos.show');
Route::get('/reclamos/buscar',[ClaimsController::class, 'search'])->name('reclamos.buscar');

//Garantia
Route::get('/garantias', [WarrantiesController::class, 'index'])->name('garantias.index');
Route::get('/garantias/create', [WarrantiesController::class, 'create'])->name('garantias.create');
Route::post('/garantias/store', [WarrantiesController::class, 'store'])->name('garantias.store');
Route::get('/garantias/edit/{id}', [WarrantiesController::class,'edit'])->name('garantias.edit');
Route::put('/garantias/{id}',  [WarrantiesController::class,'update'])->name('garantias.update');
Route::delete('/garantias/{id}', [WarrantiesController::class, 'destroy'])->name('garantias.delete');
Route::get('/garantias/show/{id}', [WarrantiesController::class, 'show'])->name('garantias.show');
Route::get('/garantias/buscar',[WarrantiesController::class, 'search'])->name('garantias.buscar');

Route::get('/garantias/producto/{id}', [WarrantiesController::class, 'buscar_producto'])->name('garantias.producto');


//reporte
Route::get('/reporte/contizaciones_pedidos', [ReportController::class, 'cotizaandpedido'])->name('report.cotandped');
Route::get('/reporte/entregas_y_despacho', [ReportController::class, 'entreanddesp'])->name('report.entranddes');
Route::get('/reporte/clientes_frecuentes', [ReportController::class, 'clients'])->name('report.clients');

//
Route::get('/permisos', [PermissionController::class, 'index'])->name('permiso.index');

Route::get('/funciones', [RoleController::class, 'index'])->name('funcion.index');
Route::get('/funciones/create', [RoleController::class, 'create'])->name('funcion.create');
Route::post('/funciones/store', [RoleController::class, 'store'])->name('funcion.store');
Route::delete('/funciones/{id}', [RoleController::class, 'destroy'])->name('funcion.delete');
Route::get('/funciones/show/{id}', [RoleController::class, 'show'])->name('funcion.show');
Route::get('/funciones/edit/{id}', [RoleController::class,'edit'])->name('funcion.edit');
Route::put('/funciones/{id}',  [RoleController::class,'update'])->name('funcion.update');

Route::get('/usuarios', [UserController::class, 'index'])->name('usuario.index');
Route::get('/usuarios/create', [UserController::class, 'create'])->name('usuario.create');
Route::post('/usuarios/store', [UserController::class, 'store'])->name('usuario.store');
Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->name('usuario.delete');
Route::get('/usuarios/edit/{id}', [UserController::class,'edit'])->name('usuario.edit');
Route::put('/usuarios/{id}',  [UserController::class,'update'])->name('usuario.update');
Route::get('/usuarios/show/{id}', [UserController::class, 'show'])->name('usuario.show');

Route::get('/bitacora', [BitacoraController::class, 'index'])->name('bitacora.index');
