<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\GenerateReportJob;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Report::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'title' => 'required|string|max:512',
            'birth_date_start' => 'required|date',
            'birth_date_end' => 'required|date',
        ]);

        $report = Report::create([
            'title' => $data['title'],
            'user_id' => $request->user()->id,
        ]);
        GenerateReportJob::dispatch($report, $data['birth_date_start'], $data['birth_date_end']);
        return response()->json([
            'message' => 'Successfully created report!',
            'report_id' => $report->id,
            'birth_date_start' => $data['birth_date_start'],
            'birth_date_end' => $data['birth_date_end'],
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        return response()->json($report, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        $report->delete();
        return response()->json([], 204);
    }
}
