<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $pageTitle   = 'All Countries';
        $countryList = getCountryList();
        $countries   = Country::searchable(['name', 'currency'])->latest()->paginate(getPaginate());
        return view('admin.countries', compact('pageTitle', 'countries', 'countryList'));
    }

    public function store(Request $request)
    {
        $this->validation($request);
        $country = new Country();
        $this->saveCountry($request, $country);
        $notify[] = ['success', 'Country added successfully'];
        return back()->withNotify($notify);
    }

    public function update(Request $request, $id)
    {

        $this->validation($request, $id);
        $country = Country::findOrFail($id);
        $country->status = $request->status ? 1 : 0;
        $this->saveCountry($request, $country);

        $notify[] = ['success', 'Country updated successfully'];
        return back()->withNotify($notify);
    }

    public function saveCountry(Request $request, $country)
    {
        $countryList             = getCountryList();
        $countryCode             = $request->country_code;
        $country->name           = @$countryList->$countryCode->country;
        $country->country_code   = $countryCode;
        $country->dial_code      = @$countryList->$countryCode->dial_code;
        $country->currency       = $request->currency;
        $country->rate           = $request->rate;
        $country->fixed_charge   = $request->fixed_charge;
        $country->percent_charge = $request->percent_charge;

        if ($request->hasFile('image')) {
            try {
                $country->image = fileUploader($request->image, getFilePath('country'), getFileSize('country'), @$country->image);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }
        $country->save();
    }

    protected function validation($request, $id = 0)
    {
        $validationRules = [
            'country_code'   => 'required|unique:countries,country_code,' . $id,
            'currency'       => 'required',
            'rate'           => 'required|numeric|gt:0',
            'fixed_charge'   => 'required|numeric|gte:0',
            'percent_charge' => 'required|numeric|gte:0',
        ];

        if ($id) {
            $imageValidation = 'nullable';
        } else {
            $imageValidation = 'required';
        }

        $validationRules['image'] = [$imageValidation, 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])];

        $request->validate($validationRules);
    }
}
