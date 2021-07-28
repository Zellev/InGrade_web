<?php

namespace App\Exports;

use App\guru;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class guruExport implements FromCollection,WithMapping,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return guru::all();
    }
    public function map($guru): array
    {
        return [
            $guru->nama,
            $guru->telpon,
            $guru->alamat,
        ];
    }
    public function headings(): array
    {
        return [
            'Nama',
            'Telpon',
            'Alamat',
        ];
    }
}
