<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('NewsDesk') }}
            </h2>
            <a href="{{ route('news_desks.create') }}" class="bg-blue-600 text-sm rounded-md text-white px-3 py-2">
                Create</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message></x-message>
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr class="border-b">
                        <th class="px-6 py-3 text-left" width="60">#</th>
                        <th class="px-6 py-3 text-left" width="220">Title</th>
                        <th class="px-6 py-3 text-left">Discription</th>
                        <th class="px-6 py-3 text-left" width="180">Created</th>
                        <th class="px-6 py-3 text-center" width="180">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if ($news_desks->isNotEmpty())
                        @foreach ($news_desks as $news)
                            <tr class="border-b">
                                <td class="px-6 py-3 text-left"> {{ $news->id }} </td>
                                <td class="px-6 py-3 text-left"> {{ $news->title }} </td>
                                <td class="px-6 py-3 text-left"> {{ $news->discription }} </td>
                                <td class="px-6 py-3 text-left">
                                    {{ \Carbon\Carbon::parse($news->created_at)->format('d M, Y') }} </td>
                                <td class="px-6 py-3 text-center">
                                    <a href="{{ route('news_desks.edit', $news->id) }}"
                                        class="bg-green-500 text-sm rounded-md text-white px-3 py-2 hover:bg-green-400 mr-2">
                                        Edit
                                    </a>
                                    <a href="javascript:void(0);" onclick="deleteNews({{ $news->id }})"
                                        class="bg-red-600 text-sm rounded-md text-white px-3 py-2 hover:bg-red-500">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="my-3">
                {{ $news_desks->links() }}
            </div>

        </div>
    </div>
    <x-slot name="script">
        <script type="text/javascript">
            function deleteNews(id) {
                if (confirm('Are you sure you want to delete this news?')) {
                    $.ajax({
                        url: '{{ route('news_desks.destroy') }}', // Use the defined route
                        type: 'DELETE',
                        data: {
                            id: id, // Send the News ID
                        },
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add the CSRF token
                        },
                        success: function(response) {
                            if (response.status) {
                                alert(response.message);
                                location.reload(); // Reload the page to update the list
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function(xhr) {
                            alert('Failed to delete News. Please try again.');
                            console.error(xhr.responseText); // Log the error for debugging
                        },
                    });
                }
            }
        </script>
    </x-slot>
</x-app-layout>
