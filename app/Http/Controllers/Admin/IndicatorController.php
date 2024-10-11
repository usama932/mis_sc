<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SCITheme;
use App\Models\SCISubTheme;


class IndicatorController extends Controller
{

    public function index()
    {
        return view('admin.indicators.index');
    }

    public function create()
    {
        $themes = SCITheme::orderBy('name')->get();
        addJavascriptFile('assets/js/custom/indicators/create.js');
        return view('admin.indicators.create',compact('themes'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function getSubthemes(Request $request)
    {
        $themeIds = $request->input('themes', []);
        
        // Adjust your query as per your database structure
        $subthemes = SCISubTheme::whereIn('sci_theme_id', $themeIds)->get();

        return response()->json(['subthemes' => $subthemes]);
    }
}
