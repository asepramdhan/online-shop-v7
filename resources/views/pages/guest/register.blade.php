<?php
use function Livewire\Volt\{state, rules};
use function Laravel\Folio\name;
use App\Models\User;
name('register');
state(['name', 'username', 'email', 'password']);
rules([
  'name' => 'required|max:255',
  'username' => 'required|min:3|max:255|unique:users',
  'email' => 'required|email|unique:users',
  'password' => 'required|min:6|max:255',
]);
$register = function () {
  $validatedData = $this->validate();
  $validatedData['password'] = Hash::make($validatedData['password']);
  User::create($validatedData);
  session()->flash('success', 'Registration success, please login');
  $this->redirect('/guest/login', navigate: true);
}
?>
<x-app-layout title="Register">
  @volt
  <div>
    <div class="row justify-content-center">
      <div class="col-lg-5">
        <h1 class="h3 mb-3 fw-normal text-center">Registration Form</h1>
        <form wire:submit='register'>
          <div class="form-floating">
            <input wire:model='name' type="text" class="form-control rounded-bottom-0 border-success @error('name') is-invalid @endif" id="name" placeholder="name">
            <label for="name">Name</label>
            @error('name')
            <div class="invalid-tooltip">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-floating">
            <input wire:model='username' type="text" class="form-control rounded-0 border-success border-top-0 @error('username') is-invalid @endif" id="username" placeholder="username">
            <label for="username">User Name</label>
            @error('username')
            <div class="invalid-tooltip">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-floating">
            <input wire:model='email' type="email" class="form-control rounded-0 border-success border-top-0 @error('email') is-invalid @endif" id="email" placeholder="name@example.com">
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
          <button class="btn btn-success bg-gradient w-100 py-2 my-2" type="submit">Register</button>
        </form>
        <small class="d-block text-center mt-1">Already registered? <a href="{{ route('login') }}" class="text-decoration-none text-success" wire:navigate>Login!</a></small>
      </div>
    </div>
  </div>
  @endvolt
</x-app-layout>
