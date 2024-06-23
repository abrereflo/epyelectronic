<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class FuntionsSeeder extends Seeder
{
    public function run()
    {
        $rolespadmin = Role::create(['name' => 'super_admin']);

        //tipo de productos
        Permission::create(['name' => 'producttype.index'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'producttype.create'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'producttype.store'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'producttype.edit'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'producttype.update'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'producttype.delete'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'producttype.show'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'UpdateStatusTipoProducto'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'producttype.buscar'])->syncRoles($rolespadmin);

        //familia de Productos
        Permission::create(['name' => 'productfamily.index'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'productfamily.create'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'productfamily.store'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'productfamily.edit'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'productfamily.update'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'productfamily.delete'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'productfamily.show'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'UpdateStatusFamiliaProducto'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'productfamily.buscar'])->syncRoles($rolespadmin);

        //producto
        Permission::create(['name' => 'product.index'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'product.create'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'product.store'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'product.edit'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'product.update'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'product.delete'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'product.show'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'UpdateStatusProducto'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'product.buscar'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'product.familia'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'product.search'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'product.list'])->syncRoles($rolespadmin);

        //almacen
        Permission::create(['name' => 'store.index'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'store.create'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'store.store'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'store.edit'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'store.update'])->syncRoles($rolespadmin);

        //inventario
        Permission::create(['name' => 'inventories.index'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'inventories.create'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'inventories.store'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'inventories.edit'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'inventories.update'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'inventories.product'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'inventories.buscar'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'inventories.show'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'inventories.delete'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'UpdateStatusInventario'])->syncRoles($rolespadmin);

        //clientes
        Permission::create(['name' => 'client.index'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'client.create'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'client.store'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'client.save_cliente'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'client.edit'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'client.update'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'client.delete'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'client.show'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'UpdateStatusclient'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'client.buscar'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'client.search'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'client.list'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'client.report'])->syncRoles($rolespadmin);

        //cotizaciones
        Permission::create(['name' => 'quote.index'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'quote.create'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'quote.store'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'quote.edit'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'quote.update'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'quote.delete'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'quote.show'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'UpdateStatusquote'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'quote.buscar'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'quote.bcliente'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'quote.bproduct'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'quote.gettable'])->syncRoles($rolespadmin);

        Permission::create(['name' => 'quote.fprod'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'quote.product'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'quote.precios'])->syncRoles($rolespadmin);

        //Pedidos
        Permission::create(['name' => 'orders.index'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'orders.create'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'orders.store'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'orders.edit'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'orders.update'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'orders.delete'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'orders.show'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'updateStatusordes'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'orders.buscar'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'orders.bclient'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'orders.detalle'])->syncRoles($rolespadmin);

        //entregas
        Permission::create(['name' => 'entregas.index'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'entregas.create'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'entregas.store'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'entregas.edit'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'entregas.update'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'entregas.delete'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'entregas.show'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'entregas.buscar'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'entregas.pedido'])->syncRoles($rolespadmin);

        //despachos
        Permission::create(['name' => 'despachos.index'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'despachos.create'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'despachos.store'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'despachos.edit'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'despachos.update'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'despachos.delete'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'despachos.show'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'despachos.buscar'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'despachos.pedido'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'despachos.report'])->syncRoles($rolespadmin);

        //reclamos
        Permission::create(['name' => 'reclamos.index'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'reclamos.create'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'reclamos.store'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'reclamos.edit'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'reclamos.update'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'reclamos.delete'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'reclamos.show'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'reclamos.buscar'])->syncRoles($rolespadmin);

        //garantias
        Permission::create(['name' => 'garantias.index'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'garantias.create'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'garantias.store'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'garantias.edit'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'garantias.update'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'garantias.delete'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'garantias.show'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'garantias.buscar'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'garantias.producto'])->syncRoles($rolespadmin);

        //reportes
        Permission::create(['name' => 'report.cotandped'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'report.entranddes'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'report.clients'])->syncRoles($rolespadmin);

        //bit
        Permission::create(['name' => 'funcion.index'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'roles.index'])->syncRoles($rolespadmin);
        Permission::create(['name' => 'usuario.index'])->syncRoles($rolespadmin);


    }
}
