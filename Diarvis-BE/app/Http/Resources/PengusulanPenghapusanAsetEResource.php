<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PengusulanPenghapusanAsetEResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'id_usulan_e' => $this->id_usulan_e,
            'id_user' => $this->id_user,
            'nama_lengkap' => $this->user->nama_lengkap,
            'id_aset_b' => $this->id_aset_e,
            'dokumen_penilaian' => $this->dokumen_penilaian,
            'foto_barang1' => $this->foto_barang1,
            'foto_barang2' => $this->foto_barang2,
            'foto_barang3' => $this->foto_barang3,
            'foto_barang4' => $this->foto_barang4,
            'alasan_penghapusan' => $this->alasan_penghapusan,
            'status_penghapusan' => $this->status_penghapusan,
            'status_penilaian' => $this->status_penilaian,
            'status_verifikasi' => $this->status_verifikasi,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
