<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Lib\FormProcessor;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class KycController extends Controller
{
    public function setting()
    {
        $type = last(request()->segments());
        if ($type != 'agent' && $type != 'user') {
            abort(404);
        }
        $pageTitle = 'KYC Setting';
        $form = Form::where('act', $type . '.kyc')->first();
        return view('admin.kyc.setting', compact('pageTitle', 'form'));
    }
    public function settingUpdate(Request $request)
    {
        $type = last(request()->segments());
        if ($type != 'agent' && $type != 'user') {
            abort(404);
        }
        $formProcessor = new FormProcessor();
        $generatorValidation = $formProcessor->generatorValidation();
        $request->validate($generatorValidation['rules'], $generatorValidation['messages']);
        $exist = Form::where('act', $type . '.kyc')->first();
        if ($exist) {
            $isUpdate = true;
        } else {
            $isUpdate = false;
        }
        $formProcessor->generate($type . '.kyc', $isUpdate, 'act');

        $notify[] = ['success', 'KYC data updated successfully'];
        return back()->withNotify($notify);
    }


    public function module()
    {
        $pageTitle = 'KYC Modules';
        $modules = GeneralSetting::first()->kyc_modules;
        return view('admin.kyc.module', compact('pageTitle', 'modules'));
    }

    public function moduleUpdate(Request $request)
    {

        $request->validate([
            'modules' => 'array|max:2',
            'modules.*' => 'nullable|array',
            'modules.*.*' => 'in:on',
        ]);
        $general = GeneralSetting::first();
        $general->kyc_modules = $request->modules;
        $general->save();
        $notify[] = ['success', 'KYC Modules updated successfully'];
        return back()->withNotify($notify);
    }
}
