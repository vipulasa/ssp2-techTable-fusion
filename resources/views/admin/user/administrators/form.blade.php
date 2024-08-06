<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-10 divide-y divide-gray-900/10">
                <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-10 md:grid-cols-3">
                    <div class="px-4 sm:px-0">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">
                            Administrator Information
                        </h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">
                            Please enter the information for the administrator you would like to add.
                        </p>
                    </div>

                    <form method="post"
                          action="{{ ($user->id ? route('admin.user.administrators.update', $user->id) : route('admin.user.administrators.store')) }}"
                          class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                        @csrf
                        @if($user->id)
                            @method('PUT')
                        @endif

                        <div class="px-4 py-6 sm:p-8">
                            <x-validation-errors class="mb-4" />
                            <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-3">
                                    <label for="name"
                                           class="block text-sm font-medium leading-6 text-gray-900">
                                        Name
                                    </label>
                                    <div class="mt-2">
                                        <input value="{{ $user->name }}" required type="text" name="name" id="name" autocomplete="given-name"
                                               class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="email"
                                           class="block text-sm font-medium leading-6 text-gray-900">
                                        Email
                                    </label>
                                    <div class="mt-2">
                                        <input required type="text" value="{{ $user->email }}" name="email" id="email" autocomplete="given-name"
                                               class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="password"
                                           class="block text-sm font-medium leading-6 text-gray-900">
                                        Password
                                    </label>
                                    <div class="mt-2">
                                        <input type="password" name="password" id="password" autocomplete="given-name"
                                               class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div
                            class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                            <button type="button"
                                    x-data
                                    @click="window.history.back();"
                                    class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                            <button type="submit"
                                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Save
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
