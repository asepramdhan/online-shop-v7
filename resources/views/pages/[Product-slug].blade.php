<?php
use function Livewire\Volt\{state};
state(['product']);
?>
<x-app-layout title="Product Detail">
  @volt
  <div>
    <div class="row justify-content-center mb-5">
      <div class="col-md-8">
        <h4>{{ $product->title }}</h4>
        <p>By. <a href="/authors/{{ $product->user->username }}" class="text-decoration-none text-success" wire:navigate>{{ $product->user->name }}</a> in <a href="/categories/{{ $product->category->slug }}" class="text-decoration-none text-success" wire:navigate>{{ $product->category->name }}</a></p>
        <img src="https://source.unsplash.com/1200x400?{{ $product->category->name }}" alt="{{ $product->category->name }}" class="img-fluid">
        <article class="my-3 fs-5">
          {!! $product->body !!}
        </article>
        <br>
        <a href="{{ route('home') }}" class="btn btn-success bg-gradient" wire:navigate>Back to home</a>
      </div>
    </div>
  </div>
  @endvolt
</x-app-layout>
