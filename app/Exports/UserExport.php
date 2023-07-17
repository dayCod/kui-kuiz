<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;

class UserExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
    * Define what the used model in this user export file.
    *
    * @var collection
    */
    protected $collection;

    /**
    * Instantiate a new User Collection instance.
    */
    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    /**
    * Instantiate a default headings.
    */
    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Email',
            'Role',
            'User Profile Image Link',
            'Created at',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $collect = collect();
        $number = 1;

        foreach ($this->collection as $key => $data) {
            $collect->push([
                $number++,
                $data->name,
                $data->email,
                $data->role,
                $data->profile_picture ?? "NULL",
                $data->created_at
            ]);
        }

        return $collect;
    }

    /**
    * Instantiate a default style.
    */
    public function styles(Worksheet $sheet)
    {
        // Formula to count from A1: to total column of row
        $range_of_alphabet = range('A', 'Z');
        $cell_range = 'A1:'.($range_of_alphabet[count($this->collection()[0]) - 1]).(count($this->collection()) + 1);
        // End Formula

        // Transform first row to Font Weight Bold
        $sheet->getStyle('1')->getFont()->setBold(true);

        // Transform sheets to bordered sheets column
        $sheet->getStyle($cell_range)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);
    }
}
