<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'foundation_id' => 'required|integer',
            'amount' => 'required|numeric|min:0.01',
            'donor_name' => 'nullable|string|max:255',
            'note' => 'nullable|string|max:500'
        ]);

        // Guardar en storage/app/donations.json
        $file = storage_path('app/donations.json');
        $donations = [];
        if (file_exists($file)) {
            $donations = json_decode(file_get_contents($file), true) ?: [];
        }

        $entry = array_merge($data, [
            'id' => Str::uuid()->toString(),
            'timestamp' => now()->toDateTimeString()
        ]);

        $donations[] = $entry;
        file_put_contents($file, json_encode($donations, JSON_PRETTY_PRINT));

        return response()->json(['status'=>'success','data'=>$entry], 201);
    }
}
