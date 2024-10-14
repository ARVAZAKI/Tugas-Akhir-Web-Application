<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class CreateAccount extends Component
{
    use WithPagination;

    public $nama, $email, $password, $role, $confirm_password; 
    public $search = '';
    public $perPage = 10;

    protected $rules = [
        'nama' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8',
        'role' => 'required',
        'confirm_password' => 'required|same:password'
    ];


    public function render()
    {
        $users = User::where('name', 'like', '%'.$this->search.'%')
                     ->orWhere('email', 'like', '%'.$this->search.'%')
                     ->paginate($this->perPage);

        return view('livewire.admin.create-account', [
            'users' => $users
        ]);
    }


    public function submit()
{
    $this->validate($this->rules);

    User::create([
        'name' => $this->nama,
        'email' => $this->email,
        'password' => Hash::make($this->password),
        'role' => $this->role
    ]);

    $this->reset(['nama', 'email', 'role', 'password', 'confirm_password']);
    
    // Ganti dispatchBrowserEvent dengan dispatch
    $this->dispatch('close-modal');
    
    // Gunakan session flash untuk pesan sukses
    session()->flash('message', 'User created successfully.');
    
    // Jika Anda ingin me-refresh halaman, gunakan:
    $this->redirect(request()->header('Referer'), navigate: true);
}
    
    public function delete($id){
        $user = User::findOrFail($id);
        $user->delete();

        session()->flash('message', 'User deleted successfully.');
    
        // Jika Anda ingin me-refresh halaman, gunakan:
        $this->redirect(request()->header('Referer'), navigate: true);    
    }


}

