<?php
namespace App\Livewire;
use Livewire\Component;

class DeleteConfirmationModal extends Component
{
    public $clientId;

    protected $listeners = ['showDeleteConfirmationModal'];

    public function showDeleteConfirmationModal($clientId)
{
    $this->showModal($clientId);
}
    public function showModal($clientId)
    {
        $this->clientId = $clientId;
        $this->dispatchBrowserEvent('show-delete-confirmation-modal');
    }

    public function deleteClientConfirmation()
    {
        // Emetti un evento per confermare l'eliminazione al componente genitore
        $this->emitUp('confirmDelete', $this->clientId);
    }

    public function render()
    {
        return view('livewire.delete-confirmation-modal');
    }
}
