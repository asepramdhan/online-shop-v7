<?php
use function Livewire\Volt\{state, mount, on};
use function Laravel\Folio\name;
use App\Models\Product;
name('products');
state(['products']);
mount(function () {
  $this->products = Product::where('user_id', auth()->user()->id)->get();
});
$delete = function ($id) {
  Product::find($id)->delete();
  $this->dispatch('products');
};
on(['products' => function () {
  $this->products = Product::where('user_id', auth()->user()->id)->get();
}]);
?>
<x-dashboard-layout>
  @volt
  <div class="vh-100">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">My Products</h1>
    </div>
    @if(session()->has('success'))
    <div class="alert alert-success col-lg-10" role="alert">
      {{ session('success') }}
    </div>
    @endif
    <div class="table-responsive small col-lg-10">
      <a href="{{ route('products.create') }}" class="btn btn-primary bg-gradient mb-2" wire:navigate>
        <i class="bi bi-plus-circle"></i>
        Add Product
      </a>
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Category</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($products as $product)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $product->title }}</td>
            <td>{{ $product->category->name }}</td>
            <td>
              <a href="/auth/products/{{ $product->slug }}" class="btn btn-info btn-sm bg-gradient" wire:navigate>
                <i class="bi bi-eye"></i>
              </a>
              <a href="/auth/products/edit/{{ $product->slug }}" class="btn btn-warning btn-sm bg-gradient" wire:navigate>
                <i class="bi bi-pencil"></i>
              </a>
              <a wire:click='delete({{ $product->id }})' onclick="return confirm('Are you sure?')" href="#" class="btn btn-danger btn-sm bg-gradient">
                <i class="bi bi-trash"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @endvolt
</x-dashboard-layout>
