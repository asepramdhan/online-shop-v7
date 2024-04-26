<?php
use function Livewire\Volt\{state};
state(['user']);
?>
<x-app-layout title="Product in {{ $user->name }}">
  @volt
  <div>
    <h1 class="mb-5">Products by {{ $user->name }}</h1>
    <div class="row">
      @foreach ( $user->products->load(['user', 'category']) as $product )
      <div class="col-md-4 mb-3">
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
  </div>
  @endvolt
</x-app-layout>
