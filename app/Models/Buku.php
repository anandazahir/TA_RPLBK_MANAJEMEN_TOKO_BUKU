<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'buku';
    protected $hidden = ["created_at", "updated_at"];
    protected $fillable =[
        'Judul',  
        'Pengarang',
        'Genre',
        'Penerbit',
        'Stock',
        'Quantity',
        'Tahun', 
        'Harga'

    ];
}
