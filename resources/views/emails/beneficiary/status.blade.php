@component('mail::message')
# Beneficiary Status Updated

The status of the beneficiary **{{ $beneficiary->name }}** has been updated to **{{ ucfirst($beneficiary->status) }}**.

**Details:**
- Unique ID: {{ $beneficiary->id }}
- Project: {{ $beneficiary->project->name }}
- Updated By: {{ auth()->user()->name }}

@component('mail::button', ['url' => route('beneficiary.details', $beneficiary->id)])
View Beneficiary
@endcomponent

Thank you,<br>
{{ config('app.name') }}
@endcomponent
