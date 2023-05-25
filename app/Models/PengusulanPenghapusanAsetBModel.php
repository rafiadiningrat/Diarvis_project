<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserModel;
use App\Models\KIBBModel;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;

class PengusulanPenghapusanAsetBModel extends Model
{
    use HasFactory, HasTimestamps;

    protected $table = 'pengusulan_penghapusan_aset_b';
    protected $guarded = ['id'];
    protected $primaryKey = 'id_usulan_b';
    public $timestamps = true;
    protected $casts = [
        'update_at' => 'datetime',
    ];

    public function getAllUsulanB()
    {
        $usulanB = PengusulanPenghapusanAsetBModel::get();
        return $usulanB;
    }

    public function getListUsulanB($id_user)
    {
        $usulanB = PengusulanPenghapusanAsetBModel::where('id_user',$id_user)->get();
        return response()->json([
            'success' => true,
            'data' => $usulanB,
            // 'data'=>$unit[0]
        ], 200);
    }

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'id_user', 'id_user');
    }

    public function kibB()
    {
        return $this->belongsTo(KIBBModel::class, 'id_aset_b', 'id_aset_b');
    }

    // public function createdBy()
    // {
    //     return $this->belongsTo(UserModel::class, 'created_by');
    // }

    // public function updatedBy()
    // {
    //     return $this->belongsTo(UserModel::class, 'update_by');
    // }
}
