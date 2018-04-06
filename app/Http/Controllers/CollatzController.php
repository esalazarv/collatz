<?php

namespace App\Http\Controllers;

use App\CollatzRecord;
use Illuminate\Http\Request;

class CollatzController extends Controller
{
    /**
     * Calculate iterations for one or two numbers
     * @param Request $request
     * @param CollatzRecord $collatzRecord
     * @param $number1
     * @param null $number2
     * @return array
     */
    public function calculate(Request $request, CollatzRecord $collatzRecord, $number1, $number2 = null)
    {
        $result         = $collatzRecord->calculateForTwoNumbers($number1, $number2);
        $range          = $result['range'];

        if (count($range) > 1) {
            $data = array_only($result, ['max', 'calculations']);
        } else {
            $data = array_first($result['calculations']);
        }

        return compact('data');
    }

    public function records(Request $request)
    {
        $data = CollatzRecord::orderBy('iterations', 'desc')->get();
        return compact('data');
    }
}
