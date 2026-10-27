<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Data Kategori
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                @if (session('success'))
                    <p class="mb-4 text-green-600">
                        {{ session('success') }}
                    </p>
                @endif

                <a href="{{ route('categories.create') }}"
                class="inline-block bg-indigo-600 text-white px-4 py-2 rounded">
                    + Tambah Kategori
                </a>

                <table class="w-full mt-4">
                    <thead>
                        <tr>
                            <th class="p-2 text-left">Nama Kategori</th>
                            <th class="p-2 text-left">Deskripsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td class="p-2">
                                    {{ $category->name }}
                                </td>
                                <td class="p-2">
                                    {{ $category->description ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="p-2 text-center">
                                    Belum ada kategori.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $categories->links() }}
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>