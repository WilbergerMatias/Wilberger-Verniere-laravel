<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::truncate();
        Permission::truncate();

        $superadmin = Role::create(['name' => 'superadmin']);
        $adminFunciones = Role::create(['name' => 'adminFunc']);
        $adminSalas = Role::create(['name' => 'adminSala']);
        $adminGenerosPeliculas = Role::create(['name' => 'adminGyP']);

        $compraIndex = Permission::create(['name' => 'compra.index']); // Permiso para listar compras
        //$compraCreate = Permission::create(['name' => 'compra.create']); // Permiso para ver la ventana de creacion de una compra
        //$compraStore = Permission::create(['name' => 'compra.store']); // Permiso para registrar una compra 
        //$compraShow = Permission::create(['name' => 'compra.show']); // Permiso para ver una compra en particular 
        //$compraEdit = Permission::create(['name' => 'compra.edit']); // Permiso para ver la ventana de modificacion de una compra
        //$compraUpdate = Permission::create(['name' => 'compra.update']); // Permiso para modificar una compra
        //$compraDestroy = Permission::create(['name' => 'compra.destroy']); // Permiso para eliminar una compra

        $funcionIndex = Permission::create(['name' => 'funcion.index']); // Permiso para listar funciones
        $funcionCreate = Permission::create(['name' => 'funcion.create']); // Permiso para ver la ventana de creacion de una funcion
        $funcionEdit = Permission::create(['name' => 'funcion.edit']); // Permiso para ver la ventana de modificacion de una funcion
        $funcionHabilitar = Permission::create(['name' => 'funcion.habilitar']); // Permiso para habilitar una funcion
        $funcionDeshabilitar = Permission::create(['name' => 'funcion.deshabilitar']); // Permiso para deshabilitar una funcion
        
        $salaIndex = Permission::create(['name' => 'sala.index']); // Permiso para listar salas
        $salaCreate = Permission::create(['name' => 'sala.create']); // Permiso para ver la ventana de creacion de una sala
        $salaEdit = Permission::create(['name' => 'sala.edit']); // Permiso para ver la ventana de modificacion de una sala
        $salaHabilitar = Permission::create(['name' => 'sala.habilitar']); // Permiso para habilitar una sala
        $salaDeshabilitar = Permission::create(['name' => 'sala.deshabilitar']); // Permiso para deshabilitar una sala
        
        $generoIndex = Permission::create(['name' => 'genero.index']); // Permiso para listar generos
        $generoCreate = Permission::create(['name' => 'genero.create']); // Permiso para ver la ventana de creacion de genero 
        $generoEdit = Permission::create(['name' => 'genero.edit']); // Permiso para ver la ventana de modificacion de genero
        $generoHabilitar = Permission::create(['name' => 'genero.habilitar']); // Permiso para habilitar una genero
        $generoDeshabilitar = Permission::create(['name' => 'genero.deshabilitar']); // Permiso para deshabilitar una genero

        $peliculaIndex = Permission::create(['name' => 'pelicula.index']); // Permiso para listar peliculas
        $peliculaCreate = Permission::create(['name' => 'pelicula.create']); // Permiso para ver la ventana de creacion de una pelicula
        $peliculaShowImage = Permission::create(['name' => 'pelicula.showImage']); // Permiso para ver la portada de una pelicula
        $peliculaEdit = Permission::create(['name' => 'pelicula.edit']); // Permiso para ver la ventana de modificacion de una pelicula
        $peliculaHabilitar = Permission::create(['name' => 'pelicula.habilitar']); // Permiso para habilitar una pelicula
        $peliculaDeshabilitar = Permission::create(['name' => 'pelicula.deshabilitar']); // Permiso para deshabilitar una pelicula
        
        
        $ordenIndex = Permission::create(['name' => 'orden.index']); // Permiso para listar ordenes
        //$ordenCreate = Permission::create(['name' => 'orden.create']); // Permiso para ver la ventana de creacion de una orden 
        //$ordenStore = Permission::create(['name' => 'orden.store']); // Permiso para registrar una orden
        //$ordenShow = Permission::create(['name' => 'orden.show']); // Permiso para ver una orden en particular 
        //$ordenEdit = Permission::create(['name' => 'orden.edit']); // Permiso para ver la ventana de modificacion de una orden
        //$ordenUpdate = Permission::create(['name' => 'orden.update']); // Permiso para modificar una orden
        //$ordenDestroy = Permission::create(['name' => 'orden.destroy']); // Permiso para eliminar una orden
        
        $superadmin->syncPermissions(
            $funcionIndex, $funcionCreate, $funcionEdit, $funcionHabilitar, $funcionDeshabilitar,
            $salaIndex, $salaCreate, $salaEdit, $salaHabilitar, $salaDeshabilitar,
            $peliculaIndex, $peliculaCreate, $peliculaShowImage,  $peliculaEdit, $peliculaHabilitar, $peliculaDeshabilitar,
            $generoIndex, $generoCreate, $generoEdit, $generoHabilitar, $generoDeshabilitar,
            $compraIndex,
            $ordenIndex,
        );
        
        $adminFunciones->syncPermissions(
            $funcionIndex, $funcionCreate, $funcionEdit, $funcionHabilitar, $funcionDeshabilitar,
            $salaIndex,
            $peliculaIndex, $peliculaShowImage,
            $generoIndex,
        );

        $adminSalas->syncPermissions(
            $funcionIndex,
            $salaIndex, $salaCreate, $salaEdit, $salaHabilitar, $salaDeshabilitar,
            $peliculaIndex, $peliculaShowImage,
            $generoIndex,
        );

        $adminGenerosPeliculas->syncPermissions(
            $funcionIndex,
            $salaIndex,
            $peliculaIndex, $peliculaCreate, $peliculaShowImage, $peliculaEdit, $peliculaHabilitar, $peliculaDeshabilitar,
            $generoIndex, $generoCreate, $generoEdit, $generoHabilitar, $generoDeshabilitar,
        );
    }
}