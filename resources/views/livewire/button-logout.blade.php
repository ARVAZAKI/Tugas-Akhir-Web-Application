<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>
<button wire:click="logout" class="flex items-center space-x-2 p-2 rounded-lg hover:bg-red-500 hover:text-white transition-colors">
      <div><img src="{{asset('assets/logout.svg')}}" alt="Logout" class="w-5 h-5"></div>
      <div>Logout</div>
  </button>
  