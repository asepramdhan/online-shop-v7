<?php
use function Livewire\Volt\{state};
use App\Models\Product;
state(['product']);
$delete = function ($id) {
  Product::find($id)->delete();
  session()->flash('success', 'Product successfully deleted');
  $this->redirect('/auth/products', navigate: true);
};
?>
<x-dashboard-layout title="Product Detail">
  @volt
  <div>
    <div class="row my-3">
      <div class="col-lg-8">
        <h4>{{ $product->title }}</h4>
        <a href="{{ route('products') }}" wire:navigate class="btn btn-success bg-gradient">
          <i class="bi bi-arrow-left"></i>
          Back to all my products
        </a>
        <a href="" class="btn btn-warning bg-gradient">
          <i class="bi bi-pencil"></i>
          Edit
        </a>
        <a wire:click='delete({{ $product->id }})' onclick="return confirm('Are you sure?')" href="#" class="btn btn-danger bg-gradient">
          <i class="bi bi-trash"></i>
          Delete
        </a>
        <img src="https://source.unsplash.com/1200x400?{{ $product->category->name }}" alt="{{ $product->category->name }}" class="img-fluid mt-3">
        <article class="my-3 fs-5">
          {!! $product->body !!}
        </article>
      </div>
    </div>
  </div>
  @endvolt
</x-dashboard-layout>
