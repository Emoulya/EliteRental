<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Modal extends Component
{
    /**
     * Nama modal.
     *
     * @var string
     */
    public string $name;

    /**
     * Menunjukkan apakah modal harus ditampilkan secara default.
     *
     * @var bool
     */
    public bool $show;

    /**
     * Menunjukkan apakah elemen di dalam modal harus difokuskan secara otomatis.
     *
     * @var bool
     */
    public bool $focusable;

    /**
     * Buat instance komponen baru.
     */
    public function __construct(string $name, bool $show = false, bool $focusable = false)
    {
        $this->name = $name;
        $this->show = $show;
        $this->focusable = $focusable;
    }

    /**
     * Dapatkan tampilan / konten yang merepresentasikan komponen.
     */
    public function render(): View
    {
        return view('components.modal');
    }
}
