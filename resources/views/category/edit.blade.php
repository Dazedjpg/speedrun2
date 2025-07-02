@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-gray-900 rounded text-white max-w-md">

    <h1 class="text-2xl font-bold mb-6">Edit Category</h1>

    <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <label class="block">
            <span class="text-white">Name</span>
            <input type="text" name="name" value="{{ old('name', $category->name) }}"
                class="w-full px-4 py-2 bg-gray-800 rounded text-white border border-gray-700" required>
            @error('name')
                <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </label>

        <button type="submit" class="bg-maroon px-4 py-2 rounded">Update</button>
        <a href="{{ route('categories.index') }}" class="ml-4 text-gray-400 hover:underline">Cancel</a>
    </form>
</div>
@endsection
