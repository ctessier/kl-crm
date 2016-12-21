<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        parent::__construct();
    }

    /**
     * Display the authenticated user profile page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('profile.show');
    }

    /**
     * Update the authenticated user information.
     *
     * @param \App\Http\Requests\ProfileRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        $this->user->fill($request->all());
        $this->user->save();

        session()->flash('success', 'Votre profil a été mis à jour avec succès !');

        return redirect()->route('profile.show');
    }
}
