@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-gray-900 rounded text-white">

    <h1 class="text-2xl font-bold mb-6">Categories</h1>

    @if(session('success'))
        <div class="bg-green-600 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('categories.create') }}" class="bg-maroon px-4 py-2 rounded mb-6 inline-block">Add New Category</a>

    <table class="w-full table-auto border-collapse border border-gray-700">
        <thead>
            <tr class="bg-gray-800">
                <th class="border border-gray-600 px-4 py-2">ID</th>
                <th class="border border-gray-600 px-4 py-2">Name</th>
                <th class="border border-gray-600 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
            <tr>
                <td class="border border-gray-700 px-4 py-2">{{ $category->id }}</td>
                <td class="border border-gray-700 px-4 py-2">{{ $category->name }}</td>
                <td class="border border-gray-700 px-4 py-2 space-x-2">
                    <a href="{{ route('categories.edit', $category) }}" class="text-blue-400 hover:underline">Edit</a>

                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline"
                        onsubmit="return confirm('Are you sure you want to delete this category?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center p-4">No categories found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
