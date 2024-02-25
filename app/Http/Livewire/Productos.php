<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;

class Productos extends Component
{
    public $productos, $descripcion, $cantidad, $id_producto;
    public $modal = 0;

    public function render()
    {
        $this->productos = Producto::all();
        return view('livewire.productos')->layout('layouts.app');
    }

    public function crear() {
        $this->limpiarCampos();
        $this->abrirModal();
    }
    
    public function abrirModal() {
        $this->modal = true;
        // dd($this->modal); // Comentamos o eliminamos este dd para evitar interrupciones innecesarias
    }
    
    public function cerrarModal() {
        $this->modal = false;
    }
    
    public function limpiarCampos() {
        $this->descripcion = '';
        $this->cantidad = '';
        $this->id_producto = '';
    }

    public function editar($id) {
        $producto = Producto::findOrFail($id);
        $this->id_producto = $id;
        $this->descripcion = $producto->descripcion;
        $this->cantidad = $producto->cantidad;
        $this->abrirModal();
    }

    public function borrar($id) {
        Producto::find($id)->delete();
        session()->flash('message', 'Registro eliminado correctamente');
    }

    public function guardar() {
        Producto::updateOrCreate(['id'=>$this->id_producto],
        [
            'descripcion' => $this->descripcion,
            'cantidad' => $this->cantidad
        ]);

        session()->flash('message', $this->id_producto ? '¡Actualización Exitosa!' : '¡Alta Exitosa!');

        $this->cerrarModal();
        $this->limpiarCampos();
    }
}
