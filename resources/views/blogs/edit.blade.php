<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white relative overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('blog.update', $blog->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">{{ __('Title') }}</label>
                            <input id="title" name="title" type="text" value="{{ old('title', $blog->title) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('title') border-red-500 @enderror">
                            @error('title')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700">{{ __('Content') }}</label>
                            <textarea id="content" name="content" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('content') border-red-500 @enderror">{{ old('content', $blog->content) }}</textarea>
                            @error('content')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700">{{ __('Category') }}</label>
                            <select id="category_id" name="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('category_id') border-red-500 @enderror">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700">{{ __('Image') }}</label>
                            <div class="mt-1 block w-full rounded-md shadow-sm border border-gray-300 p-2">
                                <input id="image" name="image" type="file" accept="image/*" 
                                       class="w-full text-gray-600 border-none focus:ring-0 focus:outline-none @error('image') border-red-500 @enderror">
                            </div>
                            @error('image')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        
                            @if($blog->image)
                                <div class="mt-4">
                                    <p class="text-sm font-medium text-gray-700">{{ __('Current Image') }}</p>
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="mt-2 h-48 w-full object-cover rounded-md border border-gray-300">
                                </div>
                            @endif
                        </div>
                        
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">{{ __('Status') }}</label>
                            <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('status') border-red-500 @enderror">
                                <option value="draft" {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>{{ __('Draft') }}</option>
                                <option value="published" {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>{{ __('Published') }}</option>
                                <option value="archived" {{ old('status', $blog->status) == 'archived' ? 'selected' : '' }}>{{ __('Archived') }}</option>
                            </select>
                            @error('status')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('blog.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:border-gray-300 focus:ring ring-gray-200 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Cancel') }}
                            </a>

                            <button type="submit" class="ml-3 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-200 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
