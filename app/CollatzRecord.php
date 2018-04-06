<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollatzRecord extends Model
{

    protected $fillable = [
        'number',
        'iterations',
    ];

    /**
     * @param int $number
     * @return bool
     */
    protected function isPeer(int $number)
    {
        $mod = $number % 2;
        return $mod === 0;
    }

    /**
     * @param int $number
     * @return float|int
     */
    protected function calculateNextValue(int $number)
    {
        return $this->isPeer($number) ? $number / 2 : ($number * 3) + 1;
    }

    /**
     * @param int $number
     * @return array
     */
    public function calculateIterations(int $number)
    {
        $iterations = [];
        while($number > 1) {
            $number = $this->calculateNextValue($number);
            array_push($iterations, $number);
        }
        return $iterations;
    }

    /**
     * @param $number1
     * @param null $number2
     * @return array
     */
    public function calculateForTwoNumbers($number1, $number2 = null)
    {
        $max = null;
        $top = CollatzRecord::max('iterations');
        $maxIterations = null;
        $range = array_filter([$number1, $number2]);
        $calculations = [];
        foreach (array_sort($range) as $value) {
            if ($value) {
                $number = (int) $value;
                $steps = $this->calculateIterations($number);
                $iterations = count($steps);
                $attributes = compact('number', 'iterations', 'steps');
                $record = new CollatzRecord($attributes);
                if ($iterations > $maxIterations) {
                    $maxIterations = $iterations;
                    $max = $attributes;
                }
                if ($maxIterations > $top) {
                    $record->save();
                }
                array_push($calculations, $attributes);
            }
        }

        return compact('range', 'max', 'calculations');
    }
}
