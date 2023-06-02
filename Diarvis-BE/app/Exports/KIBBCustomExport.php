<?php

namespace App\Exports;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Reader;
use Maatwebsite\Excel\Writer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use App\Models\KIBBModel;
use App\Models\PengusulanPenghapusanAsetBModel;

class KIBBCustomExport implements FromCollection, WithHeadings

{
    /**
    * @return \Illuminate\Support\Collection
    */

    // public function collection()
    // {
    //     $table1Data = PengusulanPenghapusanAsetBModel::where('status_verifikasi', true)->get();
    //     $table2Data = KIBBModel::join('kib_b AS kib', 'kib_b.id_aset_b', '=', 'kib.id_aset_b')->get();

    //     // Format data sesuai kebutuhan Anda
    //     $mergedData = $table1Data->concat($table2Data);
    //     $formattedData = $mergedData->map(function ($item) {
    //         return [
    //             'Kode Aset' => $item->id_aset_b,
    //             'No Reg' => $item->no_reg8,
    //             'Merk' => $item->merk,
    //             'Type' => $item->type,
    //             'CC' => $item->cc,
    //             'Bahan' => $item->bahan,
    //             'Tahun_Perolehan' => $item->tahun_perolehan,
    //             'Pabrik' => $item->nomor_pabrik,
    //             'Rangka' => $item->nomor_rangka,
    //             'Mesin' => $item->nomor_mesin,
    //             'Polisi' => $item->nomor_polisi,
    //             'BPKB' => $item->nomor_bpkb,
    //             'Asal-usul' => $item->asal_usul,
    //             'Kondisi' => $item->kondisi,
    //             'Harga' => $item->harga,
    //             'Keterangan' => $item->keterangan,
    //             'Sisa Umur' => $item->sisa_umur,
    //             'Dihapusankan/Tidak Dihapuskan' => $item->status_penghapusan,
    //             'Keterangan Penghapusan' => $item->alasan_penghapusan,
    //             // Tambahkan kolom lainnya sesuai kebutuhan
    //         ];
    //     });

    //     return $formattedData;
    // }

    // public function registerEvents(): array
    // {
    //     return [
    //         BeforeWriting::class => function (BeforeWriting $event) {
    //             $writer = $event->getWriter();
    //             $spreadsheet = $writer->getDelegate();
            
    //             // Lakukan pengeditan pada Spreadsheet di sini
            
    //             // Contoh: Menambahkan gambar
    //             $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
    //             $drawing->setName('Logo');
    //             $drawing->setDescription('Logo');
    //             $drawing->setPath(public_path('app/public/foto/logo.png'));
    //             $drawing->setHeight(50);
    //             $drawing->setCoordinates('A1');
    //             $spreadsheet->getActiveSheet()->getDrawingCollection()->offsetSet('A1', $drawing);
            
    //             // Contoh: Menambahkan keterangan
    //             $spreadsheet->getActiveSheet()->setCellValue('A2', 'Keterangan: Data dari Tabel 1 dan Tabel 2');
            
    //             $writer->setDelegate($spreadsheet); // Perubahan di sini
    //         },
    //         AfterSheet::class => function (AfterSheet $event) {
    //             // Setelah pengeditan selesai, dapatkan instance Spreadsheet
    //             $spreadsheet = $event->getSheet()->getDelegate();
            
    //             // Lakukan pengaturan tambahan jika diperlukan
    //             // Misalnya, mengatur lebar kolom, format tanggal, dll.
            
    //             // Contoh: Mengatur lebar kolom
    //             $spreadsheet->getColumnDimension('A')->setWidth(20);
            
    //             // Simpan kembali instance Spreadsheet ke dalam sheet
    //             $event->sheet->setDelegate($spreadsheet); // Perubahan di sini
    //         },
    // //         BeforeWriting::class => function (BeforeWriting $event) {
    // //             $writer = $event->getWriter();
    // //             $spreadsheet = $writer->getDelegate();

    // //                 // Lakukan pengeditan pada Spreadsheet di sini

    // //                 // Contoh: Menambahkan gambar
    // //             $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
    // //             $drawing->setName('Logo');
    // //             $drawing->setDescription('Logo');
    // //             $drawing->setPath(public_path('app/public/foto/logo.png'));
    // //             $drawing->setHeight(50);
    // //             $drawing->setCoordinates('A1');
    // //             $spreadsheet->getActiveSheet()->getDrawingCollection()->offsetSet('A1', $drawing);

    // //                 // Contoh: Menambahkan keterangan
    // //             $spreadsheet->getActiveSheet()->setCellValue('A2', 'Keterangan: Data dari Tabel 1 dan Tabel 2');

    // //             $writer->setDelegate($spreadsheet);
    // //         },
    // //             AfterSheet::class => function (AfterSheet $event) {
    // // // Setelah pengeditan selesai, dapatkan instance Spreadsheet
    // //             $spreadsheet = $event->sheet->getParent();

    // // // Lakukan pengaturan tambahan jika diperlukan
    // // // Misalnya, mengatur lebar kolom, format tanggal, dll.

    // // // Contoh: Mengatur lebar kolom
    // //             $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);

    // //             // Simpan kembali instance Spreadsheet ke dalam sheet
    // //             $event->sheet->setDelegate($spreadsheet);
    // //     }
    //     ];
    // }
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'id_aset_b',
            'no_reg8',
            'merk',
            'type',
            'cc',
            'bahan',
            'tgl_perolehan',
            'nomor_pabrik',
            'nomor_rangka',
            'nomor_mesin',
            'nomor_polisi',
            'nomor_bpkb',
            'asal_usul',
            'kondisi',
            'harga',
            'keterangan',
            'sisa_umur',
            'status_penghapusan',
            'alasan_penghapusan',
            
        ];
    }
}

