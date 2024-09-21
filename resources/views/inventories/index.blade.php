<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inventories') }}
        </h2>
    </x-slot>

    <div class="py-12"  x-data="{ count: 0 }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-10">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-gray-900">{{ __('Inventories') }}</h1>
                            <p class="mt-2 text-sm text-gray-700">
                                {{ __('List of all inventories') }}
                            </p>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <a href="{{ route('inventories.create') }}" type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white">
                                {{ __('Create Inventory') }}
                            </a>
                        </div>
                    </div>
                    <div class="mt-8 flow-root">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <div class="relative">
                                    <table class="min-w-full table-fixed divide-y divide-gray-300">
                                        <thead>
                                        <tr>
                                            <th scope="col" class="min-w-[12rem] py-3.5 pr-3 text-left text-sm font-semibold text-gray-900">
                                                {{ __('Name') }}
                                            </th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">{{ __('Quantity') }}</th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">{{ __('Price') }}</th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">{{ __('User') }}</th>
                                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-3">
                                                <span class="sr-only">{{ __('Edit') }}</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">

                                            @foreach($inventories as $inventory)
                                                <tr>
                                                    <td class="whitespace-nowrap py-4 pr-3 text-sm font-medium text-gray-900">
                                                        {{ $inventory->name }}
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        {{ $inventory->quantity }}
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        {{ $inventory->price_formated }}
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        {{ $inventory->user->name }}
                                                    </td>
                                                    <td class="flex space-x-3 whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-3">
                                                        <a href="{{ route('inventories.edit', $inventory) }}" class="text-indigo-600 hover:text-indigo-900">
                                                            {{ __('Edit') }}
                                                        </a>

                                                        <form class="delete cursor-pointer text-red-600" action="{{ route('inventories.destroy', $inventory) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <input class="text-red-600 cursor-pointer" type="submit" value="{{ __('Delete') }}">
                                                        </form>

                                                        <a href="{{ route('inventories.show', $inventory) }}" class="text-gray-600 hover:text-gray-900">
                                                            {{ __('View') }}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $inventories->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll(".delete").forEach((element) => {
            element.addEventListener("submit", function (e) {
                e.preventDefault();
                if(confirm('{{ __('Are you sure you want to delete this inventory?') }}')) {
                    this.submit();
                }
            });
        });
    </script>
</x-app-layout>
