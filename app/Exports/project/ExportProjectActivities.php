<?php

namespace App\Exports\project;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\Project;

class ExportProjectActivities implements FromView, WithStyles
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

    public function styles(Worksheet $sheet)
    {
        // Apply border styles to all cells
        $sheet->getStyle($sheet->calculateWorksheetDimension())->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // Apply specific styles to header row
        $sheet->getStyle('A1:Z1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Set column widths
        $sheet->getColumnDimension('A')->setWidth(30);
        $sheet->getColumnDimension('B')->setWidth(20);
        // Adjust column widths for other columns as needed
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
