<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('News / Create') }}
            </h2>
            <a href="{{ route('news_desks.index') }}" class="bg-yellow-400 text-sm rounded-md text-white px-3 py-2">
                Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('news_desks.store') }}" method="post">
                        @csrf
                        <div>
                            <label for="Title" class="text-lg font-medium">Title</label>
                            <div class="my-3">
                                <input value="{{ old('title') }}" name="title" placeholder="Enter Title"
                                    class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                @error('title')
                                    <p class="text-red-400 font-midium">{{ $message }}</p>
                                @enderror
                            </div>

                            <label for="Discription" class="text-lg font-medium">Discription</label>
                            <div class="my-3">
                                <textarea name="discription" placeholder="Enter Discription" id="" cols="30" rows="5"
                                    class="border-gray-300 shadow-sm w-1/2 rounded-lg"> {{ old('discription') }} </textarea>
                            </div>

                            <button class="bg-fuchsia-700 text-sm rounded-md text-white px-5 py-2">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
