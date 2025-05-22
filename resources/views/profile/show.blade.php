<x-app-layout>
    <x-slot name="header">

<h1>Mon Profil</h1>

@if(session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif

    <p><strong>Nom :</strong> {{ $user->name }}</p>
    <p><strong>Email :</strong> {{ $user->email }}</p>

  </x-slot>
</x-app-layout>

