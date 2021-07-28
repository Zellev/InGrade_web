<?php

namespace App\Exports;

use App\siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class siswaExport implements FromCollection,WithMapping,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return siswa::all();
    }
    public function map($siswa): array
    {
        return [
            $siswa->nama_lengkap(),
            $siswa->jenis_kelamin,
            $siswa->agama,
            $siswa->rataRataNilai(),
        ];
    }
    public function headings(): array
    {
        return [
            'Nama_Lengkap',
            'Jenis Kelamin',
            'Agama',
            'Rtaa-rata Nilai',
        ];
    }
}
