<?php
use function Livewire\Volt\{state};
use function Laravel\Folio\name;
state([]);
name('about')
?>
<x-app-layout title="About">
  @volt
  <div>
    <h1>Halaman About</h1>
  </div>
  @endvolt
</x-app-layout>
