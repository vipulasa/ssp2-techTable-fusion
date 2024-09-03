<?php

use function Livewire\Volt\{state, mount};

state([
    'notifications' => []
]);

mount(function () {
    $this->loadNotifications();
});

$loadNotifications = function () {
    $this->notifications = auth()
        ->user()
        ->notifications()
        ->where('read_at', null)
        ->get();
};

$markAsRead = function ($notification_id) {
    $notification = auth()
        ->user()
        ->notifications()
        ->where('id', $notification_id)
        ->first();

    $notification->markAsRead();

    $this->notifications = auth()
        ->user()
        ->notifications()
        ->where('read_at', null)
        ->get();
};

?>

<div x-data="{
    init(){
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('50a2e6693f94dde830f7', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('notification-channel');
        channel.bind('refresh-notifications', function(data) {
            @this.call('loadNotifications');
        });
    }
}">
    <div class="ms-3 relative">
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                    <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        Notifications ({{ $notifications->count() }})

                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                        </svg>
                                    </button>
                                </span>
            </x-slot>

            <x-slot name="content">
                <!-- Account Management -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Notifications') }}
                </div>

                <ul>
                    @foreach($notifications as $notification)
                        <li class="{{ !$notification->read_at ? 'bg-[#FF2D20]/10' : '' }} flex space-x-3">
                            <a href="{{ $notification->data['action'] }}"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex">

                                @if($notification->data['icon'] == 'info')
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5"/>
                                    </svg>
                                @endif


                                {{ $notification->data['message'] }}
                            </a>

                            <button type="button" wire:click="markAsRead('{{ $notification->id }}')">X</button>
                        </li>
                    @endforeach
                </ul>
            </x-slot>
        </x-dropdown>
    </div>
</div>
