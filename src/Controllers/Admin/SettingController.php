<?php

namespace Azuriom\Plugin\Stats\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\Stats\Models\Setting;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Azuriom\Plugin\stats\Requests\SettingRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Azuriom\Plugin\Stats\Models\Setting $setting
     */
    public function edit(Setting $setting)
    {
        return view('playerstats::admin.stats.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Azuriom\Plugin\Stats\Requests\SettingRequest $request
     * @param \Azuriom\Plugin\Stats\Models\Setting          $setting
     *
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, Setting $setting)
    {
        $setting->name = 'global';

        $input = [
            'database' => $request->input('database'),
            'table' => $request->input('table'),
            'column_uuid' => $request->input('column_uuid'),
            'column_name' => $request->input('column_name')
        ];

        $setting->settings = $input;
        $setting->update($request->validated());

        return redirect()->route('playerstats.admin.index')
            ->with('success', trans('playerstats::admin.setting.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Azuriom\Plugin\Stats\Models\Setting $setting
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
