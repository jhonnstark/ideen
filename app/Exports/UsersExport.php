<?php

namespace App\Exports;

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

class UsersExport implements FromView, ShouldAutoSize, WithColumnFormatting, WithTitle, WithStyles
{
    use Exportable;

    private $user;

    /**
     * @param int $user_id
     */
    public function __construct(int $user_id)
    {
        $this->user = User::find($user_id)->load('bills');
    }

    /**
     * @return View
     */
    public function view(): View
    {
        return view('exports.userBills', [
            'user' => $this->user
        ]);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Alumno ' . $this->user->name;
    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'C' => NumberFormat::FORMAT_PERCENTAGE,
            'D' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'E' => NumberFormat::FORMAT_DATE_DATETIME,
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
            2    => ['font' => ['italic' => true, 'size' => 14]],
            4    => ['font' => ['bold' => true, 'size' => 12]],

        ];
    }
}
