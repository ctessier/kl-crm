<?php

class ProfileControllerTest extends TestCase
{
    /**
     * Test profile update form validation.
     *
     * @return void
     */
    public function test_invalid_form()
    {
        $this->be(\App\User::first());

        $this->visitRoute('profile.show')
            ->type('', 'name')
            ->type('', 'email')
            ->press('Enregistrer')
            ->seeRouteIs('profile.show')
            ->see('Le champ Nom est obligatoire.')
            ->see('Le champ Adresse e-mail est obligatoire.');

        $this->visitRoute('profile.show')
            ->type('Ok', 'name')
            ->type('test', 'email')
            ->press('Enregistrer')
            ->seeRouteIs('profile.show')
            ->see('Le champ Adresse e-mail doit être une adresse e-mail valide.');

    }

    /**
     * Test user profile updating.
     *
     * @return void
     */
    public function test_it_updates_user_profile()
    {
        $this->be(\App\User::first());

        $data = [
            'name'  => 'Clark Kent',
            'email' => 'clark@kent.com',
        ];

        $this->route('PUT', 'profile.update', $data);

        $this->assertRedirectedToRoute('profile.show');
        $this->seeInDatabase('users', ['name' => 'Clark Kent']);
        $this->seeInDatabase('users', ['email' => 'clark@kent.com']);
    }
}
