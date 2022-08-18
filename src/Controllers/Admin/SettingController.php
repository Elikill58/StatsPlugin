<?php

namespace Azuriom\Plugin\PlayerStats\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Models\Setting;
use Illuminate\Http\Request;
use Azuriom\Plugin\PlayerStats\Requests\SettingRequest;

class SettingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('playerstats::admin.settings.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Azuriom\Plugin\PlayerStats\Requests\SettingRequest $request
     * @param \Azuriom\Plugin\PlayerStats\Models\Setting          $setting
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request) {
        Setting::updateSettings([
            'playerstats.database' => $request->input('database'),
            'playerstats.table' => $request->input('table'),
            'playerstats.column_uuid' => $request->input('column_uuid'),
            'playerstats.column_name' => $request->input('column_name'),
            'playerstats.stats_route' => $request->input('stats_route'),
            'playerstats.site_head' => $request->input('site_head')
        ]);

        return redirect()->route('playerstats.admin.setting')
            ->with('success', trans('playerstats::admin.setting.updated'));
    }
}
