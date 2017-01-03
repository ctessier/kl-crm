<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;

class UpdatePasswordController extends Controller
{
    /**
     * Handle an update password request.
     *
     * @param \App\Http\Requests\UpdatePasswordRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePasswordRequest $request)
    {
        $this->user->password = bcrypt($request->get('password'));
        $this->user->save();

        \Alert::success('Votre mot de passe a bien été mise à jour !')->flash();

        return redirect()->route('profile.show');
    }
}
