<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\SimpleExcel\SimpleExcelWriter;
use App\Models\Guest;

class ExportController extends Controller
{
    public function spatie(Request $request)
    {
        // Define file path
        $filePath = storage_path('exports/guests.csv');

        // Get the authenticated user's ID
        $userId = $request->user()->id;

        // Fetch data for the authenticated user's guests
        $guests = Guest::where('user_id', $userId)
            ->select('name', 'surname', 'status')
            ->get();

        // Check if the user has any guests
        if ($guests->isEmpty()) {
            return response()->json(['message' => 'No guests found for the user'], 404);
        }

        // Write data to the CSV file
        $writer = SimpleExcelWriter::create($filePath, 'csv')
            ->addHeader(['Name', 'Surname', 'Status']);

        foreach ($guests as $guest) {
            $writer->addRow([
                'Name' => $guest->name,
                'Surname' => $guest->surname,
                'Status' => $guest->status,
            ]);
        }

        $writer->close();

        // Return the file for download
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
