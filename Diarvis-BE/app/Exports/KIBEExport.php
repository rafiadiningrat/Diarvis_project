<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\KIBE;

class KIBEExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $kode_bidang;
        protected $kode_unit;
        protected $kode_sub_unit;
        protected $kode_upb;
    
        public function __construct($kode_bidang, $kode_unit, $kode_sub_unit, $kode_upb)
        {
            $this->kode_bidang = $kode_bidang;
            $this->kode_unit = $kode_unit;
            $this->kode_sub_unit = $kode_sub_unit;
            $this->kode_upb = $kode_upb;
        }
    
        /**
         * @return \Illuminate\Support\Collection
         */
        public function collection()
        {
            return KIBE::where('kode_bidang', $this->kode_bidang)
                ->where('kode_unit', $this->kode_unit)
                ->where('kode_sub_unit', $this->kode_sub_unit)
                ->where('kode_upb', $this->kode_upb)
                ->get();
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
