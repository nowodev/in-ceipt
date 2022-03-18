<?php

namespace App\Actions\Company;

use Illuminate\Support\Facades\Storage;

class DeleteCompanyLogo
{
    public function delete(): void
    {
        $user = auth()->user();

        // delete logo from storage
        Storage::disk('public')->delete($user?->company_logo_path);

        // delete logo from db
        $user?->update([
            'company_logo_path' => null,
        ]);
    }
}
