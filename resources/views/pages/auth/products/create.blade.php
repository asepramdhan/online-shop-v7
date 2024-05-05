<?php
use function Livewire\Volt\{state, rules, updated};
use function Laravel\folio\name;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;
name('products.create');
state([
  'title', 
  'slug',
  'category_id' => '1',
  'categories' => Category::all(),
  'body'
]);
rules([
  'title' => 'required|min:3|max:255', 
  'slug' => 'required|unique:products', 
  'category_id' => 'required', 
  'body' => 'required'
]);
updated(['title' => fn () => $this->slug = Str::slug($this->title)]);
$store = function () {
  $validatedData = $this->validate();
  $validatedData['user_id'] = auth()->user()->id;
  $validatedData['excerpt'] = Str::limit(strip_tags($this->body), 200);
  Product::create($validatedData);
  session()->flash('success', 'Product successfully created');
  $this->redirect('/auth/products', navigate: true);
}
?>
<x-dashboard-layout>
  @volt
  <div class="vh-100">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Create New Product</h1>
    </div>
    <div class="col-lg-8">
      <form wire:submit='store'>
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control border-dark @error('title') is-invalid @enderror" id="title" wire:model.live='title' autofocus>
          @error('title')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input type="text" class="form-control border-dark @error('slug') is-invalid @enderror" id="slug" wire:model='slug'>
          @error('slug')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="category" class="form-label">Category</label>
          <select class="form-select border-dark" id="category" wire:model='category_id'>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label for="body" class="form-label">Body</label>
          <input id="body" type="hidden" name="body" value="{{ $body }}">
          <trix-editor input="body" class="trix-content border-dark @error('body') is-invalid @enderror"></trix-editor>
          @error('body')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary mb-5 bg-gradient">Create Product</button>
      </form>
    </div>
  </div>
  <script>
    const trixEditor = document.getElementById('body');
    addEventListener('trix-blur', (event) => {
      @this.set('body', trixEditor.getAttribute('value'))
    })

    document.addEventListener('trix-file-accept', function(e) {
      e.preventDefault();
    })

  </script>
  @endvolt
</x-dashboard-layout>
