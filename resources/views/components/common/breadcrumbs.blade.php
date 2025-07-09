{{-- resources/views/components/common/breadcrumbs.blade.php --}}
@props(['links'])

<nav class="flex" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        @foreach ($links as $index => $link)
            <li>
                <div class="flex items-center">
                    @if ($index > 0)
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    @endif

                    @if (isset($link['active']) && $link['active'])
                        <span class="ml-1 text-sm font-medium text-navy md:ml-2">{{ $link['label'] }}</span>
                    @else
                        <a href="{{ $link['url'] }}"
                            class="inline-flex items-center text-sm font-medium text-gray-custom hover:text-gold">
                            @if (isset($link['icon']))
                                <i class="{{ $link['icon'] }} mr-2"></i>
                            @endif
                            {{ $link['label'] }}
                        </a>
                    @endif
                </div>
            </li>
        @endforeach
    </ol>
</nav>
