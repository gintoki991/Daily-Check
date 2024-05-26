<?php

namespace App\Livewire;

use Livewire\Component;

class DatePicker extends Component
{
  public $date;

  public function updatedDate($value)
  {
    $this->emit('dateUpdated', $value);
  }

  public function render()
  {
    return view('livewire.date-picker');
  }
}
