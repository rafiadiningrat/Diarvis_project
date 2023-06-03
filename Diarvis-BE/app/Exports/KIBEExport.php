<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\KIBEModel;

class KIBEExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return KIBEModel::all();
    }

    public function headings(): array
    {
        return [
            'id_aset_e', 
            'kode_pemilik', 
            'kode_upb', 
            'kode_sub_unit', 
            'kode_unit', 
            'kode_bidang', 
            'tgl_perolehan', 
            'judul', 
            'pencipta', 
            'bahan', 
            'ukuran', 
            'asal_usul', 
            'kondisi', 
            'harga', 
            'masa_manfaat', 
            'nilai_sisa', 
            'keterangan', 
            'tahun', 
            'no_sp2d', 
            'tgl_pembukuan', 
            'no_skguna', 
            'log_user', 
            'log_entry', 
            'kd_ka', 
            'no_sippt', 
            'kd_hapus', 
            'kd_aset8', 
            'kd_aset80', 
            'kd_aset81', 
            'kd_aset82', 
            'kd_aset83', 
            'kd_aset84', 
            'kd_aset85', 
            'created_at', 
            'created_by', 
            'update_at', 
            'update_by', 
            'jumlah',
            'is_aset_yang_ditemukan', 
            'no_reg8', 
            'jenis_aset', 
            
	
            // Tambahkan kolom-kolom lainnya sesuai dengan struktur tabel KIB B
        ];
    }
}
