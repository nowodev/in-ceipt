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

    }

    public function updateCompany(CompanySettingsRequest $request, UpdateCompanySettings $updateCompanySettings): RedirectResponse
    {
        $updateCompanySettings->update($request);

        return back();
    }

    public function deleteLogo(DeleteCompanyLogo $deleteCompanyLogo): RedirectResponse
    {
        $deleteCompanyLogo->delete();

        return back(303);
    }
}
