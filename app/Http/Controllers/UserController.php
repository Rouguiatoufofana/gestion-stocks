<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function toggleActivation(User $user)
{
    if ($user->role !== 'employe') {
        return back()->with('error', 'Action non autorisée.');
    }

    $user->is_active = !$user->is_active;
    $user->save();

    return back()->with('success', 'Statut de l\'employé mis à jour.');
}

}
