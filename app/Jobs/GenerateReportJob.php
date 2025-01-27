<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

class GenerateReportJob implements ShouldQueue
{
    use Queueable;

    protected $report;
    protected $birth_date_start;
    protected $birth_date_end;

    /**
     * Create a new job instance.
     */
    public function __construct($report, $birth_date_start, $birth_date_end)
    {
        $this->report = $report;
        $this->birth_date_start = $birth_date_start;
        $this->birth_date_end = $birth_date_end;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $fileName = 'report_' . time() .  '.xlsx';
        $filePath = 'reports/' . $fileName;

        Excel::store(
            new UsersExport(
                $this->birth_date_start,
                $this->birth_date_end,
            ),
            $filePath,
            'public',
        );

        $this->report->update([
            'report_link' => Storage::url($filePath),
        ]);
    }
}
