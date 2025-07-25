@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-24 bg-gray-900 p-6 rounded shadow-md text-white">
    <h2 class="text-2xl font-bold mb-6 text-maroon">Edit Profile</h2>

    @if(session('success'))
        <div class="mb-4 text-green-400 font-medium">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium">Name</label>
            <input
                name="name"
                type="text"
                value="{{ old('name', $user->name) }}"
                class="w-full mt-1 px-4 py-2 rounded bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-maroon"
            />
        </div>

        <div>
            <label for="email" class="block text-sm font-medium">Email</label>
            <input
                name="email"
                type="email"
                value="{{ old('email', $user->email) }}"
                class="w-full mt-1 px-4 py-2 rounded bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-maroon"
            />
        </div>

        <button
            type="submit"
            class="bg-maroon hover:bg-red-800 text-white px-4 py-2 rounded shadow transition"
        >
            Update
        </button>
    </form>

    <form
        method="POST"
        action="{{ route('profile.destroy') }}"
        class="mt-8"
        onsubmit="return confirm('Yakin ingin menghapus akun?');"
    >
        @csrf
        @method('DELETE')
        <button
            type="submit"
            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow transition"
        >
            Delete Account
        </button>
    </form>
</div>
@endsection
