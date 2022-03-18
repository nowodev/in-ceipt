<?php

namespace App\Actions\Company;

class UpdateCompanySettings
{
    public UpdateCompanyLogo $updateCompanyLogo;

    public function __construct(UpdateCompanyLogo $updateCompanyLogo)
    {
        $this->updateCompanyLogo = $updateCompanyLogo;
    }

    public function update($request): void
    {
        $cred = $request->validated();

        $user = auth()->user();

        if ($request->hasFile('logo')) {
            $this->updateCompanyLogo->update($cred['logo'], $user);
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
    }
}
