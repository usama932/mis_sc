<?php

namespace App\Exports\project;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\ProjectPartner;
use App\Models\ProjectTheme;
use App\Models\Project;
use App\Models\District;
use App\Models\Province;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportProjectActivities implements FromView
{ 
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        $project = Project::with(['quarters' => function ($query) {
            $query->orderBy('id', 'asc');
        }])->where('id', $this->data['id'])->with('detail', 'activities')->orderBy('name')->first();
        
        // Fetch other required data
        
        return view('admin.project.project_export.project_activities_project', [
            'project' => $project,
            // Pass other data to the view
        ]);
    }

    public function exportToExcel($view)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Convert the view to HTML
        $html = $view->render();

        // Load HTML content into the worksheet
        $sheet->fromArray([
            [$html]
        ]);

        // Set headers for Excel file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="export.xlsx"');
        header('Cache-Control: max-age=0');

        // Write the spreadsheet to a file
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
