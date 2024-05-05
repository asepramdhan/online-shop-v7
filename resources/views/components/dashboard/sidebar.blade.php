<?php
use function Livewire\Volt\{state};
state([]);
$logout = function () {
  Auth::logout();
  session()->invalidate();
  session()->regenerateToken();
  session()->flash('success', 'Logout success');
  $this->redirect('/guest/login', navigate: true);
}
?>
<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
  <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link d-flex gap-1 {{ Route::is('dashboard') ? 'text-dark' : '' }}" href="{{ route('dashboard') }}" wire:navigate>
            <i class="bi bi-house"></i>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex gap-1 {{ Route::is('products*') ? 'text-dark' : '' }}" href="{{ route('products') }}" wire:navigate>
            <i class="bi bi-box"></i>
            Products
          </a>
        </li>
      </ul>
      <hr class="my-3">
      @volt
      <ul class="nav flex-column mb-auto">
        <li class="nav-item">
          <a wire:click="logout" class="nav-link d-flex gap-1" href="#">
            <i class="bi bi-box-arrow-right"></i>
            Logout
          </a>
        </li>
      </ul>
      @endvolt
    </div>
  </div>
</div>
