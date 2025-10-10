<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingAdminController extends Controller
{
    public function index()
    {
        $settings = Setting::orderBy('group')->get();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // TODO: persist form -> settings
        return back()->with('success', 'Paramètres enregistrés');
    }
}