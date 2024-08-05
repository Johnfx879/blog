<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Post') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <a href="{{ route('blog.create') }}" class="ml-3 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-200 disabled:opacity-25 transition ease-in-out duration-150">Create Post</a>
    </div>
    
    <div class="max-w-5xl mx-auto py-6 px-2">
        <ul class="divide-y">
            @foreach($blogs as $blog)
                <li class="py-4 px-2">
                    <a href="{{ route('blog.show', $blog) }}" class="text-xl font-semibold block">{{ $blog->title }}</a>
                    <p class="text-sm text-gray-600">
                        {{ $blog->created_at->diffForHumans() }} 
                        @if($blog->user)
                            by {{ $blog->user->name }}
                        @endif
                    </p>
                    <p class="mt-2 text-gray-800">
                        {{ Str::limit($blog->content, 100) }}
                    </p>
                    <span class="inline-block px-2 py-1 mt-2 text-xs font-semibold text-white {{ $blog->status == 'published' ? 'bg-green-500' : 'bg-red-500' }}">
                        {{ ucfirst($blog->status) }}
                    </span>
                </li>
            @endforeach
        </ul>

        <div class="mt-2">
            {{ $blogs->links() }}
        </div>
    </div>
</x-app-layout>
