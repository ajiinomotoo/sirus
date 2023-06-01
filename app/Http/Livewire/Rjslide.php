<?php

namespace App\Http\Livewire;

use App\Http\Controllers\RjslideController;
use Livewire\Component;
use App\Models\rstxnRjhdrs;

class Rjslide extends Component
{
    public $currentStep = 1;
    public $rj_no, $rj_date, $reg_no, $poli_id, $dr_id, $klaim_id;
    public $successMessage = '';

    public function render()
    {
        return view('livewire.rjslide', [
            'noRj' => RjslideController::myRjno(),
            'autodate' => RjslideController::autodate()
        ]);
    }

    public function firstStepSubmit()
    {
        $validatedData = $this->validate([
            'reg_no' => 'required|min:7'
        ]);

        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $validatedData = $this->validate([
            'rj_no_step2' => 'required',
            'rj_date_step2' => 'required',
            'reg_no_step2' => 'required',
            'poli_id_step2' => 'required',
            'dr_id_step2' => 'required',
            'klaim_id_step2' => 'required'
        ]);

        $this->currentStep = 3;
    }

    public function submitForm()
    {
        rstxnRjhdrs::create([
            'rj_no_step3' => $this->rj_no,
            'rj_date_step3' => $this->rj_date,
            'reg_no_step3' => $this->reg_no,
            'poli_id_step3' => $this->poli_id,
            'dr_id_step3' => $this->dr_id,
            'klaim_id_step3' => $this->klaim_id,
        ]);

        $this->successMessage = 'Product Created Successfully.';

        $this->clearForm();

        $this->currentStep = 1;
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function clearForm()
    {
        $this->rj_no = '';
        $this->rj_date = '';
        $this->reg_no = '';
        $this->poli_id = '';
        $this->dr_id = '';
        $this->klaim_id = '';
    }
}
