@extends('layouts.principalLayout')


@section('title','Products')
    

@section('body')




<div class="modal" tabindex="-1" id="productModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Crear producto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{route('products.store')}}" method="POST" class="row-cols-1">
            @csrf
          <label for="" class="col">Nombre<input type="text" name="name" class="form-control"></label>
          <label for="" class="col">Cantidad<input type="number" name="stock" class="form-control"></label>
          <label for="" class="col">Precio<input type="number" name="cost" class="form-control"></label>
          <input type="submit" class="btn btn-success mt-2" value="Guardar">
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  @if (session('status'))
      <h3 class="text-center">{{session('status')}}</h3>
  @endif
  <h3></h3>

  <button type="button" class="btn btn-primary my-5" data-toggle="modal" data-target="#productModal" style="float: right">
    Crear
  </button>


<table>
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Cantidad</th>
        <th>Costo</th>
        <th>Acciones</th>
    </tr>
</thead>

<tbody>
    @foreach ($products as $product)
        <tr>
            <td>{{$product['name']}}</td>
            <td>{{$product['stock']}}</td>
            <td>{{$product['cost']}}</td>
            <td>
                <button class=" btn btn-secondary" id="btnEdit" data-id="{{$product['id']}}">Editar</button>
                <button class="btn btn-danger">Eliminar</button>
            </td>
        </tr>
    @endforeach
</tbody>



</table>

@endsection

@section('js')
<script src=".{{asset('js/products/modal.js')}}" crossorigin="anonymous"></script>

@endsection