<?php

namespace App\Exports;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UserGeneralExport implements FromView, ShouldAutoSize, WithColumnFormatting, WithTitle, WithStyles
{
    use Exportable;

    private $bills;

    /**
     * @param array $range
     */
    public function __construct(array $range)
    {
        $this->bills = Bill::where('paid_at', '>', $range['start'])
            ->where('paid_at', '<', $range['end'])
            ->with('user')
            ->get();
    }

    /**
     * @return View
     */
    public function view(): View
    {
        return view('exports.bills', ['bills' => $this->bills]);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Alumnos';
    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'D' => NumberFormat::FORMAT_PERCENTAGE,
            'E' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'F' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet): array
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true, 'size' => 14]],
            'A'    => ['font' => ['italic' => true, 'size' => 14]],
        ];
    }
}
