<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Post') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4">
        <a href="{{ route('blog.create') }}"
            class="ml-3 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-200 disabled:opacity-25 transition ease-in-out duration-150">Create
            Post</a>
    </div>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach ($blogs as $blog)
                        <div class="py-4 px-2 border-b border-gray-300">
                            <a href="{{ route('blog.show', $blog) }}"
                                class="text-xl font-semibold block">{{ $blog->title }}</a>
                            <p class="text-sm text-gray-600">
                                {{ $blog->created_at->diffForHumans() }}
                            </p>
                            <p class="mt-2 text-gray-800">
                                {{ Str::limit($blog->content, 100) }}
                            </p>
                            <span
                                class="inline-block px-2 py-1 mt-2 text-xs font-semibold text-white {{ $blog->status == 'published' ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ ucfirst($blog->status) }}
                            </span>
                            <div class="mt-4">
                                <a href="{{ route('blog.edit', $blog) }}"
                                    class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring ring-yellow-200 disabled:opacity-25 transition ease-in-out duration-150">Edit</a>

                                <form action="{{ route('blog.destroy', $blog) }}" method="POST"
                                    class="inline-block ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:border-red-700 focus:ring ring-red-200 disabled:opacity-25 transition ease-in-out duration-150"
                                        onclick="return confirm('Are you sure you want to delete this post?');">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{ $blogs->links() }}
        </div>
    </div>
</x-app-layout>
