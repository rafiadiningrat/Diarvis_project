<?php

namespace App\Exports;

use App\Models\KIBBModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KIBBExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return KIBBModel::all();
    }

    public function headings(): array
    {
        return [
            'id_aset_b', 
            'kode_pemilik', 
            'kode_upb', 
            'kode_sub_unit', 
            'kode_unit', 
            'kode_bidang', 
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
            'masa_manfaat', 
            'nilai_sisa', 
            'keterangan', 
            'tahun', 
            'no_sp2d', 
            'no_skguna', 
            'kd_penyusutan', 
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
            'nilai_susut1',
            'nilai_susut2', 
            'akum_susut', 
            'sisa_umur', 
            'is_aset_yang_ditemukan', 
            'no_reg8', 
            'jenis_aset', 
            'kd_aset', 
            'kd_aset0',
	
        ];
    }
}
