<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>
            <a href="{{ route('users.create') }}" class="bg-blue-600 text-sm rounded-md text-white px-3 py-2">
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
                        <th class="px-6 py-3 text-left" width="200">User Name</th>
                        <th class="px-6 py-3 text-left" width="200">Email</th>
                        <th class="px-6 py-3 text-left">Role</th>
                        <th class="px-6 py-3 text-left" width="160">Created</th>
                        <th class="px-6 py-3 text-center" width="180">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if ($users->isNotEmpty())
                        @foreach ($users as $user)
                            <tr class="border-b">
                                <td class="px-6 py-3 text-left"> {{ $user->id }} </td>
                                <td class="px-6 py-3 text-left"> {{ $user->name }} </td>
                                <td class="px-6 py-3 text-left"> {{ $user->email }} </td>
                                <td class="px-6 py-3 text-left"> {{ $user->roles->pluck('name')->implode(', ') }} </td>
                                <td class="px-6 py-3 text-left">
                                    {{ \Carbon\Carbon::parse($user->created_at)->format('d M, Y') }} </td>
                                <td class="px-6 py-3 text-center">
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="bg-green-500 text-sm rounded-md text-white px-3 py-2 hover:bg-green-400 mr-2">
                                        Edit
                                    </a>
                                    <a href="javascript:void(0);" onclick="deleteUser({{ $user->id }})"
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
                {{ $users->links() }}
            </div>

        </div>
    </div>
    <x-slot name="script">
        <script type="text/javascript">
            function deleteUser(id) {
                if (confirm('Are you sure you want to delete this user?')) {
                    $.ajax({
                        url: '{{ route('users.destroy') }}',
                        type: 'DELETE',
                        data: {
                            id: id,
                        },
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            if (response.status) {
                                alert(response.message);
                                location.reload();
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function(xhr) {
                            alert('Failed to delete User. Please try again.');
                            console.error(xhr.responseText);
                        },
                    });
                }
            }
        </script>
    </x-slot>
</x-app-layout>
