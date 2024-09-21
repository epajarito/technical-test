<form class="px-10" method="post" action="@if($inventory?->id) {{ route('inventories.update', $inventory) }} @else {{ route('inventories.store') }} @endif">
    @csrf
    @if( $inventory->exists )
        @method('PUT')
    @endif
    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base font-semibold leading-7 text-gray-900">
                {{ __('Inventory information') }}
            </h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">
                {{ __('Edit the information of the inventory') }}
            </p>

            <div class="mt-10 flex flex-col max-w-7xl items-center space-y-5">
                <div class="flex flex-col w-1/2">
                    <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">
                        {{ __('Name') }}
                    </label>
                    <div class="mt-2">
                        <input {{ request()->routeIs('inventories.show') ? 'readonly' : '' }} value="{{ old('name', $inventory->name) }}" required type="text" name="name" id="name" autocomplete="name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col w-1/2">
                    <label for="description" class="block text-sm font-medium leading-6 text-gray-900">
                        {{ __('Description') }}
                    </label>
                    <div class="mt-2">
                        <textarea {{ request()->routeIs('inventories.show') ? 'readonly' : '' }} id="description" name="description" rows="3" class="text-black block w-full rounded-md bg-white/5 py-1.5 sm:text-sm sm:leading-6">{{ old('description', $inventory->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex space-x-5 w-1/2">
                    <div class="sm:col-span-2_ sm:col-start-1">
                        <label for="quantity" class="block text-sm font-medium leading-6 text-gray-900">
                            {{ __('Quantity') }}
                        </label>
                        <div class="mt-2">
                            <input {{ request()->routeIs('inventories.show') ? 'readonly' : '' }} value="{{ old('quantity', $inventory->quantity) }}" type="number" step="1" name="quantity" id="quantity" required autocomplete="quantity" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('quantity')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-2_">
                        <label for="price" class="block text-sm font-medium leading-6 text-gray-900">
                            {{ __('Price') }}
                        </label>
                        <div class="mt-2">
                            <input {{ request()->routeIs('inventories.show') ? 'readonly' : '' }} value="{{ old('price', $inventory->price) }}" step="any" type="number" name="price" id="price" autocomplete="price" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                            @error('price')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="my-6 flex items-center justify-end gap-x-6">
        @if(request()->routeIs('inventories.show'))
            <a href="{{ route('inventories.index') }}" class="text-sm font-semibold leading-6 text-gray-900">
                {{ __('Back') }}
            </a>
        @else
            <a href="{{ route('inventories.index') }}" class="text-sm font-semibold leading-6 text-gray-900">
                {{ __('Cancel') }}
            </a>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                {{ __('Save') }}
            </button>
        @endif
    </div>
</form>
