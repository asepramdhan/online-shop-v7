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
<nav class="navbar navbar-expand-lg navbar-dark bg-success bg-gradient">
  <div class="container">
    <a class="navbar-brand" href="/" wire:navigate>Online Shop V7</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}" wire:navigate>Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::is('about') ? 'active' : '' }}" href="{{ route('about') }}" wire:navigate>About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::is('categories') ? 'active' : '' }}" href="{{ route('categories') }}" wire:navigate>Categories</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Welcome back, {{ Auth::user()->name }}
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="{{ route('dashboard') }}" wire:navigate>
                <i class="bi bi-layout-text-sidebar-reverse me-1"></i>
                My Dashboard
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            @volt
            <li>
              <a wire:click="logout" class="dropdown-item" href="#">
                <i class="bi bi-box-arrow-right me-1"></i>
                Logout
              </a>
            </li>
            @endvolt
          </ul>
        </li>
        @else
        <li class="nav-item">
          <a href="{{ route('login') }}" class="nav-link {{ Route::is('login') ? 'active' : '' }}" wire:navigate>
            <i class="bi bi-box-arrow-in-right"></i>
            Login
          </a>
        </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
