{{-- resources/views/components/public/booking-timeline.blade.php --}}
@props(['currentStep'])

<div class="bg-white border-b">
    <div class="container mx-auto px-4 py-6">
        <div class="flex items-center justify-center space-x-8">
            {{-- Step 1: Detail Booking --}}
            @php
                $isStep1Passed = $currentStep > 1;
                $isStep1Active = $currentStep === 1;
                $step1CircleClass = $isStep1Passed
                    ? 'bg-green-500 text-white'
                    : ($isStep1Active
                        ? 'bg-navy text-white'
                        : 'bg-gray-300 text-gray-500');
                $step1TextClass = $isStep1Passed
                    ? 'text-green-600 font-medium'
                    : ($isStep1Active
                        ? 'text-navy font-medium'
                        : 'text-gray-500');
            @endphp
            <div class="flex items-center">
                <div
                    class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold {{ $step1CircleClass }}">
                    @if ($isStep1Passed)
                        <i class="fas fa-check"></i>
                    @else
                        1
                    @endif
                </div>
                <span class="ml-3 {{ $step1TextClass }}">Detail Booking</span>
            </div>

            {{-- Line 1-2 --}}
            @php
                $line1Class = $isStep1Passed ? 'bg-green-500' : 'bg-gray-300';
            @endphp
            <div class="w-16 h-0.5 {{ $line1Class }}"></div>

            {{-- Step 2: Pembayaran --}}
            @php
                $isStep2Passed = $currentStep > 2;
                $isStep2Active = $currentStep === 2;
                $step2CircleClass = $isStep2Passed
                    ? 'bg-green-500 text-white'
                    : ($isStep2Active
                        ? 'bg-navy text-white'
                        : 'bg-gray-300 text-gray-500');
                $step2TextClass = $isStep2Passed
                    ? 'text-green-600 font-medium'
                    : ($isStep2Active
                        ? 'text-navy font-medium'
                        : 'text-gray-500');
            @endphp
            <div class="flex items-center">
                <div
                    class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold {{ $step2CircleClass }}">
                    @if ($isStep2Passed)
                        <i class="fas fa-check"></i>
                    @else
                        2
                    @endif
                </div>
                <span class="ml-3 {{ $step2TextClass }}">Pembayaran</span>
            </div>

            {{-- Line 2-3 --}}
            @php
                $line2Class = $isStep2Passed ? 'bg-green-500' : 'bg-gray-300';
            @endphp
            <div class="w-16 h-0.5 {{ $line2Class }}"></div>

            {{-- Step 3: Konfirmasi --}}
            @php
                $isStep3Completed = $currentStep === 3; // Jika langkah aktif adalah 3, anggap sudah selesai untuk tampilan
                $step3CircleClass = $isStep3Completed ? 'bg-green-500 text-white' : 'bg-gray-300 text-gray-500';
                $step3TextClass = $isStep3Completed ? 'text-green-600 font-medium' : 'text-gray-500';
            @endphp
            <div class="flex items-center">
                <div
                    class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold {{ $step3CircleClass }}">
                    @if ($isStep3Completed)
                        {{-- Tampilkan ceklis jika sudah selesai/aktif di langkah 3 --}}
                        <i class="fas fa-check"></i>
                    @else
                        3
                    @endif
                </div>
                <span class="ml-3 {{ $step3TextClass }}">Konfirmasi</span>
            </div>
        </div>
    </div>
</div>
