<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="homepage">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="hidden sm:block">
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                            @foreach($categories as $category)
                                <button type="button" x-on:click="changeTab({{ $category->id }})"
                                        class="whitespace-nowrap border-b-2 border-transparent px-1 py-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
                                    {{ $category->name }}
                                </button>
                            @endforeach
                        </nav>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach($categories as $category_parent)
                        @foreach($category_parent->children as $category)
                            <li x-show="{{ $category->parent_id }} === activeTab"
                                x-on:click="changeCategory({{ $category->id }})"
                                class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">
                                <div class="flex w-full items-center justify-between space-x-6 p-6">
                                    <div class="flex-1 truncate">
                                        <div class="flex items-center space-x-3">
                                            <h3 class="truncate text-sm font-medium text-gray-900">
                                                {{ $category->name }}
                                            </h3>
                                        </div>
                                        <p class="mt-1 truncate text-sm text-gray-500">
                                            {{ $category->description }}
                                        </p>
                                    </div>
                                    <img class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300"
                                         src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60"
                                         alt="">
                                </div>
                            </li>
                        @endforeach
                    @endforeach
                </ul>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach($products as $product)
                    <div class="group relative bg-white p-2 rounded-xl" x-show="activeCategory === {{ $product->category->id }}">
                        <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                            <img src="https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-01.jpg" alt="Front of men&#039;s Basic Tee in black." class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                        </div>
                        <div class="mt-4 flex justify-between">
                            <div>
                                <h3 class="text-sm text-gray-700">
                                    <a href="#">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        {{ $product->name }}
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $product->description }}
                                </p>
                            </div>
                            <p class="text-sm font-medium text-gray-900">
                                ${{ $product->price }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>



    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('homepage', () => ({
                activeTab: 1,
                activeCategory: 1,
                changeTab(index) {
                    this.activeTab = index
                    this.activeCategory = index
                },
                changeCategory(index) {
                    this.activeCategory = index
                }
            }))
        })
    </script>
</x-app-layout>
