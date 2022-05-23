<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Lib\Traits\ActiveModelTrait;

class Color extends Model
{

    use HasFactory, ActiveModelTrait;

    //ATTR

    protected $table = 'colors';

    protected $fillable = [
        'name',
        'hex_value',
        'status'
    ];

    //OTHERS
    public static function createNewEntity($data = [])
    {
        return self::create($data);
    }

    public function edit($data = [])
    {
        $this->update($data);
        $this->handleHexValue($data['hex_value']);
        $this->save();
    }


    /**
     * Function handle hex value for database.
     * 
     * @param string $hexValue
     */
    public function handleHexValue($hexValue)
    {
        $this->hex_value = "#" . $hexValue;
    }
}
