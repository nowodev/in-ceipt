<?php

namespace App\Actions\Company;

use Illuminate\Support\Facades\Storage;

class UpdateCompanyLogo
{
    public function update($logo, $user): void
    {
        // Check if image already exists in the folder. If it does,
        // delete the previous and insert the new logo into the
        // storage folder then store the path into the db.

        tap($user->company_logo_path, function ($previous) use ($user, $logo) {
            $user->update([
                'company_logo_path' => $logo->storePublicly('logo', ['disk' => 'public']),
            ]);

            if ($previous) {
                Storage::disk('public')->delete($previous);
            }
        });
    }
}
