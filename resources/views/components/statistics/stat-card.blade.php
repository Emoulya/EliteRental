@props([
    'title',
    'value',
    'icon',
    'iconBgColor',
    'iconTextColor',
    'trend' => null,
    'trendColor' => null,
    'trendIcon' => null,
])

<div class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center justify-between">
        <div>
            <div class="text-2xl font-bold text-navy">
                {{ $value }}
            </div>
            <div class="text-gray-custom">
                {{ $title }}
            </div>
            @if ($trend)
                <div class="text-sm {{ $trendColor }} mt-1">
                    <i class="fas fa-{{ $trendIcon }} mr-1"></i>{{ $trend }}
                </div>
            @endif
        </div>
        <div class="p-3 rounded-full {{ $iconBgColor }} {{ $iconTextColor }}">
            <i class="fas fa-{{ $icon }} text-xl"></i>
        </div>
    </div>
</div>
