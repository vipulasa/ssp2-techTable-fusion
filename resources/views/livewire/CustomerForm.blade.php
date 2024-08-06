<?php

use function Livewire\Volt\{state};

state([
    'user_id' => null
]);


$getCustomer = function () {
    dd('here');
};
?>

<div x-data="{
    showModal: false,
    user_id: @entangle('user_id'),
    init() {
        document.addEventListener('open-customer-modal', (event) => {
            this.showModal = true;
            this.user_id = event.detail.id;
        });
    },
}">
    <div x-show="showModal"
         class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <form method="post"
                      action="{{ route('admin.user.customers.store') }}"
                      class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                    @csrf
                    <div
                        class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                        <div>
                            <div class="mt-3 text-center sm:mt-5">
                                <div class="px-4 py-6 sm:p-8">
                                    <x-validation-errors class="mb-4"/>
                                    <div class="max-w-2xl">
                                        <div class="sm:col-span-3">
                                            <label for="name"
                                                   class="block text-sm font-medium leading-6 text-gray-900">
                                                Name
                                            </label>
                                            <div class="mt-2">
                                                <input required type="text" name="name" id="name"
                                                       autocomplete="given-name"
                                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            </div>
                                        </div>

                                        <div class="sm:col-span-3">
                                            <label for="email"
                                                   class="block text-sm font-medium leading-6 text-gray-900">
                                                Email
                                            </label>
                                            <div class="mt-2">
                                                <input required type="text" name="email" id="email"
                                                       autocomplete="given-name"
                                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            </div>
                                        </div>

                                        <div class="sm:col-span-3">
                                            <label for="password"
                                                   class="block text-sm font-medium leading-6 text-gray-900">
                                                Password
                                            </label>
                                            <div class="mt-2">
                                                <input type="password" name="password" id="password"
                                                       autocomplete="given-name"
                                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6">
                            <button type="submit"
                                    class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
