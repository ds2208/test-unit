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
    public function getPhotoUrl() {
        return '/themes/front/img/' . $this->photo;
    }

    public function deletePhoto() {
        if (!$this->photo) {
            return $this;
        }

        $photoPath = public_path('/storage/ads/' . $this->photo);

        if (is_file($photoPath)) {
            unlink($photoPath);
        }
        return $this;
    }

     public function changeIndex() {
        if ($this->index == 0) {
            $this->index = 1;
            return $this;
        }
        $this->index = 0;
        return $this;
    }
    
    public function isOnIndexPage(){
        if($this->index == 1){
            return true;
        }
        return false;
    }
}
