<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\VendorApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class VendorApplicationController extends Controller
{
    public function showForm() {
        return view('vendor-application');
    }

    public function submit(Request $request) {
        $request->validate([
            'financial_score' => 'required',
            'reputation' => 'required',
            'regulatory_proof' => 'required|file|mimes:pdf|max:2048',
        ]);
        $pdfPath = $request->file('regulatory_proof')->store('vendor_proofs', 'public');

        // Send data to Spring Boot server
        $response = Http::post('http://<SPRING_BOOT_SERVER>/api/vendor/validate', [
            'user_id' => Auth::id(),
            'role' => Auth::user()->role,
            'financial_score' => $request->financial_score,
            'reputation' => $request->reputation,
            // Optionally send PDF as base64 or just notify of upload
        ]);

        VendorApplication::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role,
            'financial_score' => $request->financial_score,
            'reputation' => $request->reputation,
            'regulatory_proof' => $pdfPath,
        ]);
        return redirect()->route('dashboard')->with('success', 'Application submitted!');
    }
}
