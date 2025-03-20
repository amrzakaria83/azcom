<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Validator;

class SettingsController extends Controller
{

    public function edit($id)
    {
        $data = Setting::find($id);
        return view('teacher.setting.edit', compact('data'));
    }

    public function update(Request $request)
    {

        $items = $request->except('_token');
        
        $data = Setting::find(1);
        $data->update($items);

        // if($request->hasFile('logo')){
        //     $data->addMultipleMediaFromRequest(['logo'])->each(function ($fileAdder) {
        //         $fileAdder->toMediaCollection('logo');
        //     });
        // }

        if($request->hasFile('logo') && $request->file('logo')->isValid()){
            $data->addMediaFromRequest('logo')->toMediaCollection('logo');
        }

        if($request->hasFile('logodark') && $request->file('logodark')->isValid()){
            $data->addMediaFromRequest('logodark')->toMediaCollection('logoDark');
        }

        if($request->hasFile('fav') && $request->file('fav')->isValid()){
            $data->addMediaFromRequest('fav')->toMediaCollection('fav');
        }

        if($request->hasFile('logoft') && $request->file('logoft')->isValid()){
            $data->addMediaFromRequest('logoft')->toMediaCollection('logoft');
        }

        if($request->hasFile('logosc') && $request->file('logosc')->isValid()){
            $data->addMediaFromRequest('logosc')->toMediaCollection('logosc');
        }

        if($request->hasFile('logoth') && $request->file('logoth')->isValid()){
            $data->addMediaFromRequest('logoth')->toMediaCollection('logoth');
        }

        if($request->hasFile('breadcrumb') && $request->file('breadcrumb')->isValid()){
            $data->addMediaFromRequest('breadcrumb')->toMediaCollection('breadcrumb');
        }

        return redirect('admin/settings/edit/1')->with('message', 'تم التعديل بنجاح')->with('status', 'success');
    }

}
