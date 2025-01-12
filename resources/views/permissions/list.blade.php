<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Permissions') }}
            </h2>
            <a href="{{ route('permissions.create') }}" class="bg-blue-600 text-sm rounded-md text-white px-3 py-2">
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
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left" width="180">Created</th>
                        <th class="px-6 py-3 text-center" width="180">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if ($permissions->isNotEmpty())
                        @foreach ($permissions as $permission)
                            <tr class="border-b">
                                <td class="px-6 py-3 text-left"> {{ $permission->id }} </td>
                                <td class="px-6 py-3 text-left"> {{ $permission->name }} </td>
                                <td class="px-6 py-3 text-left">
                                    {{ \Carbon\Carbon::parse($permission->created_at)->format('d M, Y') }} </td>
                                <td class="px-6 py-3 text-center">
                                    <a href="{{ route('permissions.edit', $permission->id) }}"
                                        class="bg-green-500 text-sm rounded-md text-white px-3 py-2 hover:bg-green-400 mr-2">
                                        Edit
                                    </a>
                                    <a href="javascript:void(0);" onclick="deletePermission({{ $permission->id }})"
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
                {{ $permissions->links() }}
            </div>

        </div>
    </div>
    <x-slot name="script">
        <script type="text/javascript">
            function deletePermission(id) {
                if (confirm('Are you sure you want to delete this permission?')) {
                    $.ajax({
                        url: '{{ route('permissions.destroy') }}', // Use the defined route
                        type: 'DELETE',
                        data: {
                            id: id, // Send the permission ID
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
                            alert('Failed to delete permission. Please try again.');
                            console.error(xhr.responseText); // Log the error for debugging
                        },
                    });
                }
            }
        </script>
    </x-slot>
</x-app-layout>
