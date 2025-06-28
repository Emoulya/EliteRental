@props(['message', 'type' => 'info'])

@php
    $bgColor = 'bg-blue-500'; // Default
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
        {{-- <span>{{ $message }}</span> --}}
    </div>
</div>

{{-- Skrip untuk menampilkan dan menyembunyikan pesan --}}
@once
    @push('scripts')
        <script>
            function showCustomMessage(message, type = 'info') {
                const messageBox = document.getElementById('customMessageBox');
                if (!messageBox) {
                    console.error('customMessageBox element not found.');
                    return;
                }

                // Hapus kelas warna sebelumnya
                messageBox.classList.remove('bg-blue-500', 'bg-green-500', 'bg-red-500', 'bg-yellow-500');

                let bgColor = 'bg-blue-500'; // Default
                if (type === 'success') {
                    bgColor = 'bg-green-500';
                } else if (type === 'error') {
                    bgColor = 'bg-red-500';
                } else if (type === 'warning') {
                    bgColor = 'bg-yellow-500';
                }

                messageBox.classList.add(bgColor);
                messageBox.querySelector('span').textContent = message;

                // Atur ikon berdasarkan tipe (opsional, bisa lebih kompleks)
                const iconElement = messageBox.querySelector('i');
                iconElement.className = ''; // Hapus kelas ikon sebelumnya
                if (type === 'success') {
                    iconElement.classList.add('fas', 'fa-check-circle', 'mr-2');
                } else if (type === 'error') {
                    iconElement.classList.add('fas', 'fa-exclamation-triangle', 'mr-2');
                } else if (type === 'warning') {
                    iconElement.classList.add('fas', 'fa-exclamation-circle', 'mr-2');
                } else {
                    iconElement.classList.add('fas', 'fa-info-circle', 'mr-2');
                }

                messageBox.classList.remove('hidden');

                setTimeout(() => {
                    messageBox.classList.add('hidden');
                }, 3000); // Message disappears after 3 seconds
            }
        </script>
    @endpush
@endonce
