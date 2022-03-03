<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{

    use HasFactory;

    //ATTR
    protected $table = 'measurements';
    protected $fillable = [
        'title',
        'top_left_sensor',
        'top_right_sensor',
        'bottom_left_sensor',
        'bottom_right_sensor',
        'vertical_engine',
        'horizontal_engine',
        'status',
        'user_id'
    ];

    //RELATIONS

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'measurement_id', 'id');
    }

    //OTHERS

    public function getFrontUrl()
    {
        return route('front.measurements.single', [
            'measurement' => $this->id,
            'seoSlug' => \Str::slug($this->title)
        ]);
    }

    public function getMaxLight()
    {
        $max = $this->top_left_sensor;
        if ($this->top_right_sensor > $max) {
            $max = $this->top_right_sensor;
        } else if ($this->bottom_left_sensor > $max) {
            $max = $this->bottom_left_sensor;
        } else if ($this->bottom_right_sensor > $max) {
            $max = $this->bottom_right_sensor;
        }
        return $max;
    }

    public function getSyncShowFront()
    {
        $tableLights = [
            [
                $this->top_left_sensor,
                $this->top_right_sensor,
                $this->bottom_left_sensor,
                $this->bottom_right_sensor,
                $this->vertical_engine,
                $this->horizontal_engine,
            ]
        ];
        $max = $this->getMaxLight();
        for ($i = 1; $i <= 10; $i++) {
            if ($this->top_left_sensor > $max) {
                $tableLights[$i][] = $this->top_left_sensor - $i;
            } else {
                $tableLights[$i][] = $this->top_left_sensor + $i;
            }

            if ($this->top_right_sensor > $max) {
                $tableLights[$i][] = $this->top_right_sensor - $i;
            } else {
                $tableLights[$i][] = $this->top_right_sensor + $i;
            }

            if ($this->bottom_left_sensor > $max) {
                $tableLights[$i][] = $this->bottom_left_sensor - $i;
            } else {
                $tableLights[$i][] = $this->bottom_left_sensor + $i;
            }

            if ($this->bottom_right_sensor > $max) {
                $tableLights[$i][] = $this->bottom_right_sensor - $i;
            } else {
                $tableLights[$i][] = $this->bottom_right_sensor + $i;
            }

            if ($this->vertical_engine > $this->horizontal_engine) {
                $tableLights[$i][] = $this->vertical_engine - $i;
                $tableLights[$i][] = $this->horizontal_engine + $i;
            } else {
                $tableLights[$i][] = $this->vertical_engine + $i;
                $tableLights[$i][] = $this->horizontal_engine - $i;
            }
        }

        return $tableLights;
    }

    public function getArrayOfSensors()
    {
        return [
            $this->top_left_sensor,
            $this->top_right_sensor,
            $this->bottom_left_sensor,
            $this->bottom_right_sensor
        ];
    }

    public function changeIndex()
    {
        if ($this->index == 0) {
            $this->index = 1;
            return $this;
        }
        $this->index = 0;
        return $this;
    }

    public function isOnIndexPage()
    {
        if ($this->index == 1) {
            return true;
        }
        return false;
    }

    public function dateInAgoFormat()
    {
        $blogDate = strtotime($this->created_at);
        $currentDate = time();
        $diff = abs($currentDate - $blogDate);
        $day = 60 * 60 * 24;
        $oneMonth = $day * 30;
        $oneYear = $oneMonth * 12;

        $years = floor($diff / $oneYear);
        $months = floor(($diff - $years * $oneYear) / $oneMonth);
        $days = floor(($diff - $years * $oneYear - $months * $oneMonth) / $day);

        if ($years > 0) {
            return $years . ' years ago';
        } elseif ($months > 0) {
            return $months . ' months ago';
        } else {
            return $days . ' days ago';
        }
    }

    public function datePresenter()
    {
        return date('d F | Y', strtotime($this->created_at));
    }

    public function changeStatus()
    {
        if ($this->status == 0) {
            $this->status = 1;
            return $this;
        }
        $this->status = 0;
        return $this;
    }

    public function calculateEngineValues($data)
    {

        //define engines horizontal and vertical

        //horizontal
        $servoHorizontalLimitHigh = 160;
        $servoHorizontalLimitLow = 60;

        //vertical
        $servoVerticalLimitHigh = 160;
        $servoVerticalLimitLow = 60;

        $servoVertical = $data['vertical_engine'];
        $servoHorizontal = $data['horizontal_engine'];

        //Valore Analogico delle fotoresistenza
        $topl = $data['top_left_sensor'];
        $topr = $data['top_right_sensor'];
        $botl = $data['bottom_left_sensor'];
        $botr = $data['bottom_right_sensor'];
        // Calcoliamo una Media
        $avgtop = ($topl + $topr); //average of top 
        $avgbot = ($botl + $botr); //average of bottom 
        $avgleft = ($topl + $botl); //average of left 
        $avgright = ($topr + $botr); //average of right 

        while ($avgtop == $avgbot && $avgright == $avgleft) {
            if ($avgtop < $avgbot) {
                $avgbot--;
                $avgtop++;
                $servoVertical++;
                if ($servoVertical > $servoVerticalLimitHigh) {
                    $servoVertical = $servoVerticalLimitHigh;
                }
            } else if ($avgbot < $avgtop) {
                $avgbot++;
                $avgtop--;
                $servoVertical--;
                if ($servoVertical < $servoVerticalLimitLow) {
                    $servoVertical = $servoVerticalLimitLow;
                }
            }

            if ($avgleft > $avgright) {
                $avgleft--;
                $avgright++;
                $servoHorizontal++;
                if ($servoHorizontal > $servoHorizontalLimitHigh) {
                    $servoHorizontal = $servoHorizontalLimitHigh;
                }
            } else if ($avgright > $avgleft) {
                $avgleft++;
                $avgright--;
                $servoHorizontal--;
                if ($servoHorizontal < $servoHorizontalLimitLow) {
                    $servoHorizontal = $servoHorizontalLimitLow;
                }
            }
        }

        return [
            'servo_vertical' => $servoVertical,
            'servo_horizontal' => $servoHorizontal
        ];
    }
}
