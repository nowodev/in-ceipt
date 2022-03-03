<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Inertia\Response;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BankSettingsRequest;
use App\Http\Requests\CompanySettingsRequest;

class SettingsController extends Controller
{
    public function index(): Response
    {
        $setting = Setting::where('user_id', auth()->id())->firstOrFail();

        $bank_details = Bank::where('user_id', auth()->id())->first();

        return inertia('Settings/Show', [
            'setting' => $setting,
            'bank_details' => $bank_details
        ]);

    }

    public function updateCompany(CompanySettingsRequest $request): RedirectResponse
    {
        $cred = $request->validated();

        $user = auth()->user();

        if (isset($input['logo'])) {
            $user?->updateProfilePhoto($input['logo']);
        }

        $user?->setting()->update([
            'company_name' => $cred['company_name'],
            'address' => $cred['address']
        ]);

        return back();
    }

    public function updateBank(BankSettingsRequest $request): RedirectResponse
    {
        $cred = $request->validated();

        $user = auth()->user();

        $bank_details = Bank::where('user_id', $user?->id)->first();

        if (is_null($bank_details)) {
            $user?->bank()->create($cred);
        } else {
            $user?->bank()->update($cred);
        }

        return back();
    }

    protected function updateProfilePicture($logo)
    {
        // insert logo into db and storage...
    }
}
