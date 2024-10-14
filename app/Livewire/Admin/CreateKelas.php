<?php

namespace App\Livewire\Admin;

use App\Models\Kelas;
use Livewire\Component;

class CreateKelas extends Component
{
    public $nama_kelas = '';
    public $kode_kelas = '';
    public $kelas;

    protected $rules = [
        'nama_kelas' => 'required'
    ];

    public function mount()
    {
        $this->loadKelas();
    }

    public function render()
    {
        return view('livewire.admin.create-kelas');
    }

    public function delete($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

    
        // Muat ulang data kelas setelah penghapusan
        $this->loadKelas();
        $this->redirect(request()->header('Referer'), navigate: true);
        session()->flash('message', 'Class deleted successfully.');
    

    }

    private function loadKelas()
    {
        $this->kelas = Kelas::all();
    }
}