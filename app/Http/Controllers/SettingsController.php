<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CompanySettingsRequest;

class SettingsController extends Controller
{
    public function updateCompany(CompanySettingsRequest $request): RedirectResponse
    {
        $cred = $request->validated();

        $user = auth()->user();

        if ($request->hasFile('logo')) {
            $this->updateLogo($cred['logo'], $user);
        }

        $user?->update([
            'company_name' => $cred['company_name'],
            'address_1' => $cred['address_1'],
            'address_2' => $cred['address_2'],
            'mobile_no' => $cred['mobile_no'],
            'office_no' => $cred['office_no'],
            'bank_name' => $cred['bank_name'],
            'account_name' => $cred['account_name'],
            'account_number' => $cred['account_number'],
        ]);

        return back();
    }

    protected function updateLogo($logo, $user): void
    {
        // insert logo into db and storage...
        $user->update([
            'company_logo_path' => $logo->storePublicly('logo', ['disk' => 'public']),
        ]);
    }
}
