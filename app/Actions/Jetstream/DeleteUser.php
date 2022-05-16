<?php

namespace App\Actions\Jetstream;

use App\Models\InvoiceDetails;
use App\Models\User;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
        $user->customers()->delete();
        $user->invoices()->delete();
        InvoiceDetails::where('invoice_id', $user->id)->delete();
        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->delete();
    }
}