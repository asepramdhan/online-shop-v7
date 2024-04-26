<?php
use function Livewire\Volt\{computed, state, usesPagination};
use function Laravel\Folio\name;
use App\Models\Product;
usesPagination();
name('home');
state(['search',])->url();
$products = computed(function () {
    return Product::where('title', 'like', '%'.$this->search.'%')
    ->orWhere('body', 'like', '%'.$this->search.'%')
    ->latest()
    ->paginate(7)->withQueryString();
});
?>
<x-app-layout title="All Products">
  @volt
  <div>
    <h1 class="mb-3 text-center">All Products</h1>
    <div class="row mb-3 justify-content-center">
      <div class="col-md-6">
        <input wire:model.live="search" type="search" class="form-control border-success" placeholder="Search product...">
      </div>
    </div>
    @if($this->products->count())
    <div class="card mb-3">
      <img src="https://source.unsplash.com/1200x400?{{ $this->products->first()->category->name }}" class="card-img-top" alt="{{ $this->products->first()->category->name }}">
      <div class="card-body text-center">
        <h3 class="card-title">
          <a href="/{{ $this->products->first()->slug }}" class="text-decoration-none text-dark" wire:navigate>{{ $this->products->first()->title }}</a>
        </h3>
        <p>
          <small class="text-body-secondary">
            By. <a href="/authors/{{ $this->products->first()->user->username }}" class="text-decoration-none text-success" wire:navigate>{{ $this->products->first()->user->name }}</a> in <a href="/categories/{{ $this->products->first()->category->slug }}" class="text-decoration-none text-success" wire:navigate>{{ $this->products->first()->category->name }}</a> {{ $this->products->first()->created_at->diffForHumans() }}
          </small>
        </p>
        <p class="card-text">{{ $this->products->first()->excerpt }}</p>
        <a href="/{{ $this->products->first()->slug }}" class="text-decoration-none btn btn-success bg-gradient" wire:navigate>Read more</a>
      </div>
    </div>
    <div class="row">
      @foreach ( $this->products->skip(1) as $product )
      <div class="col-md-4 mb-3" wire:key='{{ $product->id }}'>
        <div class="card">
          <div class="position-absolute text-bg-dark px-3 py-2 opacity-75 bg-gradient">
            <a href="/categories/{{ $product->category->slug }}" class="text-decoration-none text-light" wire:navigate>{{ $product->category->name }}</a>
          </div>
          <img src="https://source.unsplash.com/500x400?{{ $product->category->name }}" class="card-img-top" alt="{{ $product->category->name }}">
          <div class="card-body">
            <h5 class="card-title">
              <a href="/{{ $product->slug }}" class="text-decoration-none text-success" wire:navigate>{{ $product->title }}</a>
            </h5>
            <p>
              <small class="text-body-secondary">
                By. <a href="/authors/{{ $product->user->username }}" class="text-decoration-none text-success" wire:navigate>{{ $product->user->name }}</a> {{ $product->created_at->diffForHumans() }}
              </small>
            </p>
            <p class="card-text">{{ $product->excerpt }}</p>
            <a href="/{{ $product->slug }}" class="btn btn-success bg-gradient" wire:navigate>Read more</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    @else
    <p class="text-center fs-4">No products</p>
    @endif
    <div class="mb-5">
      {{ $this->products->links() }}
    </div>
  </div>
  @endvolt
</x-app-layout>
