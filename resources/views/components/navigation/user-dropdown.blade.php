{{-- resources/views/components/navigation/user-dropdown.blade.php --}}
<x-dropdown align="right" width="48">
    <x-slot name="trigger">
        <button class="flex items-center text-white font-semibold focus:outline-none">
            {{ Auth::user()->name }}
            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
    </x-slot>

    <x-slot name="content">
        <x-dropdown-link :href="route('profile.edit')">
            {{ __('Profil') }}
        </x-dropdown-link>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Logout') }}
            </x-dropdown-link>
        </form>
    </x-slot>
</x-dropdown>
