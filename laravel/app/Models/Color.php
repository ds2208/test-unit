<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model {

    use HasFactory;

    //ATTR
    protected $table = 'colors';
    
    protected $fillable = [
        'name',
        'hex_value',
        'status'
    ];

    //OTHERS
    public function handleHexValue($hexValue) {
        $this->hex_value = "#" . $hexValue;
    }

     public function changeStatus() {
        $this->update([
            'status' => !$this->status,
        ]);
        return $this;
    }
}
