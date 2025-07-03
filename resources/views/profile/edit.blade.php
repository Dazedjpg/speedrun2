@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-6">
    <h2 class="text-xl font-semibold mb-4">Edit Profile</h2>

    @if(session('success'))
        <div class="text-green-600">{{ session('success') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name">Name</label>
            <input name="name" value="{{ old('name', $user->name) }}" class="w-full border rounded p-2" />
        </div>

        <div class="mb-4">
            <label for="email">Email</label>
            <input name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded p-2" />
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
