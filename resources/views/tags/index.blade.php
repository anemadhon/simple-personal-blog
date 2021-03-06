<x-app-layout>
    <x-slot name="header">
        {{ __('List of Tags') }}
    </x-slot>

    @if ($message = Session::get('success'))
        <div class="inline-flex w-full mb-4 overflow-hidden bg-white rounded-lg shadow-md">
            <div class="flex items-center justify-center w-12 bg-green-500">
                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z">
                    </path>
                </svg>
            </div>

            <div class="px-4 py-2 -mx-3">
                <div class="mx-3">
                    <span class="font-semibold text-green-500">Success</span>
                    <p class="text-sm text-gray-600">{{ $message }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div class="flex items-center rounded-lg shadow-xs">
                <a href="{{ route('author.tags.create') }}" 
                    class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                    <span>Add</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2 -mr-1" fill="none" viewBox="0 0 22 22" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </a>
            </div>
            <div
                class="relative w-full max-w-xl rounded-md focus-within:text-purple-500 border"
            >
                <div class="absolute inset-y-0 flex items-center pl-2">
                    <svg
                        class="w-4 h-4"
                        aria-hidden="true"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                    >
                        <path
                        fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd"
                        ></path>
                    </svg>
                </div>
                <form action="{{ route('author.tags.index') }}" method="get">
                    <input
                        class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-50 border-0 rounded-md focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                        type="search"
                        name="keyword"
                        value="{{ request('keyword') }}"
                        placeholder="Search User and Hit Enter"
                        aria-label="Search"
                    />
                </form>
            </div>
        </div>

        <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
            <div class="overflow-x-auto w-full">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                    <tr class="text-xs text-center font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                        <th class="px-4 py-3">No.</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                    @forelse ($tags as $tag)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 text-sm text-center">
                                {{ $tags->firstItem() + $loop->index }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $tag->name }}
                            </td>
                            <td class="px-4 py-3 flex justify-center">
                                <div class="flex items-center space-x-4 text-sm">
                                    <button
                                    class="flex items-center justify-between text-sm font-medium leading-5 text-purple-600 rounded-lg focus:outline-none focus:shadow-outline-gray"
                                    aria-label="Edit"
                                    >
                                        <a href="{{ route('author.tags.edit', ['tag' => $tag]) }}">
                                            <svg
                                                class="w-5 h-5"
                                                aria-hidden="true"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                                                ></path>
                                            </svg>
                                        </a>
                                    </button>
                                    <form action="{{ route('author.tags.destroy', ['tag' => $tag]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button
                                        class="flex items-center justify-between text-sm font-medium leading-5 text-purple-600 rounded-lg focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Delete" type="submit"
                                        >
                                            <svg
                                                class="w-5 h-5"
                                                aria-hidden="true"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd"
                                                ></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 text-sm text-center" colspan="6">
                                {{ __('No Tags Found') }}
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
                {{ $tags->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
