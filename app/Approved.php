<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Approved extends Model
{
    protected $table = 'approved';
    protected $fillable = [
        'type', 'parent_id', 'content', 'user_id'
    ];

    const TYPE_ORDER = 1; // duyệt đơn hàng
    const TYPE_IMPORT_COLOR = 2; // duyệt nhâp mau
    const TYPE_MACHINE_ARRANGEMENT = 3; // duyet bieu sap xep may
    const TYPE_EXPORT_SEMIFINISHED = 4; // Xuat kho ban thanh pham
    const TYPE_EXPORT_STOCK = 5; // Xuat kho vat lieu
    const TYPE_SCRAP = 6; // nhập phe
    public function user() {
        return $this->belongsTo('\App\User', 'user_id');
    }
}
