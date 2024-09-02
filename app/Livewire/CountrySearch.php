<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Country;

class CountrySearch extends Component
{
    public $search = '';
    public $countries = [];
    public $selectedCountry = null;

    public function updatedSearch()
    {
        $this->countries = Country::where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function selectCountry($countryId)
    {
        $this->selectedCountry = $countryId;
        $this->search = Country::find($countryId)->name;
        $this->countries = [];
        $this->emit('countrySelected', $countryId);
    }

    public function render()
    {
        return view('livewire.country-search');
    }
}
