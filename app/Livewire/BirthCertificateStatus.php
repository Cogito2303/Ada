<?php

namespace App\Livewire;

use App\Models\BirthCertificate;
use Livewire\Component;

class BirthCertificateStatus extends Component
{
    public $certificate;
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount(BirthCertificate $certificate)
    {
        $this->certificate = $certificate;
    }

    public function toggleStatus()
    {
        $this->certificate->status = $this->certificate->status === 'pending' ? 'processed' : 'pending';
        $this->certificate->save();
    }

    public function render()
    {
        return view('livewire.birth-certificate-status');
    }
}
