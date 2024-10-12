<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.dashboard-layout')] class extends Component {
    public $guru = [
        [
            'mata_kuliah' => 'Praktek Pemograman',
            'kelas' => '12 RPL 1',
        ],
        [
            'mata_kuliah' => 'Praktek Pemograman',
            'kelas' => '12 RPL 1',
        ],
        [
            'mata_kuliah' => 'Basis Data II',
            'kelas' => '14 RPL 1',
        ],
    ];
}; ?>

<div>
    <div class="container">
        <div class="flex items-center justify-center h-screen">
            <div class="min-w-full px-4 py-3 space-y-16 border-2">
                <div class="space-y-3">
                    <div class="text-lg font-semibold text-[#0d3676]">Form izin</div>
                    <div>
                        <div class="text-[#0d3676]">Keterangan</div>
                        <div class="flex justify-center min-w-full">
                            <textarea name="" class="w-full py-20 placeholder-center h-52 bg-slate-100" placeholder="Keterangan..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center py-3">
                    <div class="w-max rounded-md bg-[#d6fc92] px-14 py-1 font-semibold transition-all hover:bg-[#c0f090] active:bg-green-100">Submit</div>
                </div>
            </div>
        </div>
    </div>




</div>