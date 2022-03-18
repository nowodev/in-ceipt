<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Actions\Company\DeleteCompanyLogo;
use App\Http\Requests\CompanySettingsRequest;
use App\Actions\Company\UpdateCompanySettings;

class SettingsController extends Controller
{
    public function setup()
    {
        return inertia('Wizard/AccountSetup');
    }

    public function setupWizard(CompanySettingsRequest $request, UpdateCompanySettings $updateCompanySettings): RedirectResponse
    {
        $updateCompanySettings->update($request);

        return redirect(RouteServiceProvider::HOME)->banner('Account Setup Successfully');

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

    public function updateCompany(CompanySettingsRequest $request, UpdateCompanySettings $updateCompanySettings): RedirectResponse
    {
        $updateCompanySettings->update($request);

        return back();
    }

    public function deleteLogo(): RedirectResponse
    {
        $user = auth()->user();

        // delete logo from storage
        Storage::disk('public')->delete($user?->company_logo_path);

        // delete logo from db
        $user?->update([
            'company_logo_path' => null,
        ]);

        return back(303);
    }
}
