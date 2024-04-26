<?php
use function Livewire\Volt\{state};
use function Laravel\Folio\name;
use App\Models\Category;
name('categories');
state([
  'categories' => Category::all()
]);
?>
<x-app-layout title="Kategories">
  @volt
  <div>
    <div class="row">
      @foreach ( $categories as $category )
      <div class="col-md-4">
        <a href="/categories/{{ $category->slug }}" wire:navigate>
          <div class="card shadow border-0">
            <img src="https://source.unsplash.com/500x500?{{ $category->name }}" class="card-img" alt="{{ $category->name }}">
            <div class="card-img-overlay d-flex align-items-center p-0">
              <h5 class="card-title text-center flex-fill text-bg-dark p-4 opacity-50 fs-3 bg-gradient">{{ $category->name }}</h5>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
  @endvolt
</x-app-layout>
