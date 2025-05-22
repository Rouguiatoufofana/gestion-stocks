<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    /**
     * Affiche la page de visualisation du profil
     */
    public function show()
    {
        $user = auth()->user();
        return view('profile.show', compact('user')); // ← Affiche les infos, pas le formulaire
    }

    /**
     * Affiche le formulaire d'édition du profil
     */
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Met à jour les informations du profil
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user->update($request->only('name', 'email'));

        return redirect()->route('profile.show')->with('success', 'Profil mis à jour !');
    }

    /**
     * Supprime le compte utilisateur
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    // methode pour admin
    //     use App\Models\User;

    // public function index()
    // {
    //     $users = User::all();
    //     return view('admin.users.index', compact('users'));
    // }

    // public function adminEdit(User $user)
    // {
    //     return view('admin.users.edit', compact('user'));
    // }

    // public function adminUpdate(Request $request, User $user)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //     ]);

    //     $user->update($request->only('name', 'email'));
    //     return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour.');
    // }

    // public function adminDestroy(User $user)
    // {
    //     $user->delete();
    //     return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé.');
    // }

}

