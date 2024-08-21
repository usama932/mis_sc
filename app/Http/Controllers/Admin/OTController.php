<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OTController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apiToken = '9742a49db588994dae7593ec22d976ba8632f4f2';
        $formId = 'a7EmE4zZvMmPzasoS6rMy3'; // Replace with your form ID
        $baseUrl = "https://kobo.savethechildren.net/api/v2/assets/ahQcRFeXdkmGkNM2udu7BX/data.json/";

        // Step 1: Retrieve the submitted data for the specific form
        $response = Http::withHeaders([
            'Authorization' => "Token $apiToken",
        ])->get($baseUrl);

        if ($response->successful()) {
            $formData = $response->json();

            // Process the form data here
            // Example: Output form data
            dd($formData);
        } else {
            // Handle errors
            dd('Error fetching data for form', $response->status(), $response->body());
        }
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
