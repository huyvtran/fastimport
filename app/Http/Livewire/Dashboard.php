<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $users_down_count;

    public function render()
    {
        $users = User::where('path', 'LIKE', Auth::user()->path . '%');

        if (Auth::user()->path!=0) {
            $users =  $users->where('upline_id', '>', Auth::user()->upline_id);
        }

        $users =  $users->get();
        
        if (Auth::user()->path!=0) {
            $users_2 = User::where('path', '=', Auth::user()->path)
            ->get();
            
            $users = $users->merge($users_2);
        }

        $this->users_down_count = count($users)-1;
        
        return view('livewire.dashboard');
    }
}
