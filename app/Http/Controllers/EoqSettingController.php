<?php

namespace App\Http\Controllers;

use App\Models\EOQSetting;
use Illuminate\Http\Request;

class EoqSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'EOQ Settings List';
        $eoqSettings = EOQSetting::all();

        return view('pages.eoq_settings.index', compact('title', 'eoqSettings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create EOQ Setting';

        return view('pages.eoq_settings.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ordering_cost' => 'required|numeric|min:0',
            'storage_cost' => 'required|numeric|min:0',
            'lead_time' => 'required|integer|min:1',
        ]);

        EOQSetting::create($request->all());

        return redirect()->route('eoq_settings.index')->with('success', 'EOQ Setting created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(EOQSetting $eOQSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EOQSetting $eoqSetting)
    {
        $title = 'Edit EOQ Setting';

        return view('pages.eoq_settings.edit', compact('title', 'eoqSetting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EOQSetting $eoqSetting)
    {
        $request->validate([
            'ordering_cost' => 'required|numeric|min:0',
            'storage_cost' => 'required|numeric|min:0',
            'lead_time' => 'required|integer|min:1',
        ]);

        $eoqSetting->update($request->all());

        return redirect()->route('eoq_settings.index')->with('success', 'EOQ Setting updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EOQSetting $eoqSetting)
    {
        $eoqSetting->delete();

        return redirect()->route('eoq_settings.index')->with('success', 'EOQ Setting deleted successfully.');
    }
}
