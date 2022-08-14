<?php

namespace Azuriom\Plugin\Stats\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Models\Setting;
use Illuminate\Http\Request;
use Azuriom\Plugin\Stats\Requests\SettingRequest;

class SettingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Azuriom\Plugin\Stats\Requests\SettingRequest $request
     * @param \Azuriom\Plugin\Stats\Models\Setting          $setting
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request) {
        Setting::updateSettings([
            'playerstats.database' => $request->input('database'),
            'playerstats.table' => $request->input('table'),
            'playerstats.column_uuid' => $request->input('column_uuid'),
            'playerstats.column_name' => $request->input('column_name')
        ]);

        return redirect()->route('playerstats.admin.index')
            ->with('success', trans('playerstats::admin.setting.updated'));
    }
}
