<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SettingsRequest;

class SettingsController extends Controller
{
    public function index()
    {
        $setting = Setting::where('user_id', auth()->id())->firstOrNew();

        return Inertia::render('Settings/Show', [
            'setting' => $setting
        ]);

    }

    public function updateCompany(SettingsRequest $request): RedirectResponse
    {
        $cred = $request->validated();

        $user = auth()->user();

        if (isset($input['logo'])) {
            $user?->updateProfilePhoto($input['logo']);
        }

        $user?->settings()->update([
            'company_name' => $cred['company_name'],
            'address' => $cred['address']
        ]);

        return back();
    }

    public function bank()
    {

    }

    protected function updateProfilePicture($logo)
    {
        // insert logo into db and storage...
    }
}
