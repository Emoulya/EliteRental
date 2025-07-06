{{-- resources\views\components\messages\custom-message.blade.php --}}
@props(['message', 'type' => 'info'])

@php
    $bgColor = 'bg-blue-500';
    if ($type === 'success') {
        $bgColor = 'bg-green-500';
    } elseif ($type === 'error') {
        $bgColor = 'bg-red-500';
    } elseif ($type === 'warning') {
        $bgColor = 'bg-yellow-500';
    }
@endphp

<div id="customMessageBox"
    class="fixed bottom-4 right-4 p-4 rounded-lg shadow-lg text-white z-[9999] {{ $bgColor }} hidden">
    <div class="flex items-center">
        <i class="fas fa-info-circle mr-2"></i>
        <span></span>
    </div>
</div>
