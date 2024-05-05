<?php
use function Livewire\Volt\{state};
use function Laravel\Folio\name;
name('dashboard');
state([]);
?>
<x-dashboard-layout>
  @volt
  <div class="vh-100">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Welcome back, {{ auth()->user()->name }}</h1>
    </div>
  </div>
  @endvolt
</x-dashboard-layout>
