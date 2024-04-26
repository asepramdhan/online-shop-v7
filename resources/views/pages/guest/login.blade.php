<?php
use function Livewire\Volt\{state, rules};
use function Laravel\Folio\name;
name('login');
state(['email', 'password']);
rules(['email' => 'required|email:dns', 'password' => 'required']);
$login = function () {
  $credentials = $this->validate();
  if (Auth::attempt($credentials)) {
    session()->regenerate();
    $this->redirect('/auth/dashboard', navigate: true);
  }
  session()->flash('error', 'Login failed, please try again');
}
?>
<x-app-layout title="Login">
  @volt
  <div>
    <div class="row justify-content-center">
      <div class="col-lg-4">
        <h1 class="h3 mb-3 fw-normal text-center">Please login</h1>
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <form wire:submit='login'>
          <div class="form-floating">
            <input wire:model='email' type="email" class="form-control rounded-bottom-0 border-success @error('email') is-invalid @endif" id="email" placeholder="name@example.com" autofocus>
            <label for="email">Email address</label>
            @error('email')
            <div class="invalid-tooltip">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-floating">
            <input wire:model='password' type="password" class="form-control rounded-top-0 border-success border-top-0 @error('password') is-invalid @endif" id="password" placeholder="Password">
            <label for="password">Password</label>
            @error('password')
            <div class="invalid-tooltip">{{ $message }}</div>
            @enderror
          </div>
          <button class="btn btn-success bg-gradient w-100 py-2 my-2" type="submit">Login</button>
        </form>
        <small class="d-block text-center mt-1">Not registered? <a href="{{ route('register') }}" class="text-decoration-none text-success" wire:navigate>Register Now!</a></small>
      </div>
    </div>
  </div>
  @endvolt
</x-app-layout>
