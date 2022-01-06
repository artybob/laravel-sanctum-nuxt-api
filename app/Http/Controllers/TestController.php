<?php

namespace App\Http\Controllers;

use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function functTest2()
    {
        $A=[4, 9, 8, 2, 6];
        $K=4;

        rsort($A);

        $smallestEven=0; $smallestOdd=0; $lastEven=0; $lastOdd=0;
        $s=0;
        for($i=0; $i<=$K-1; $i++)
        {
            $s+=$A[$i];
            if($A[$i] % 2==0)
            {
                $smallestEven=$A[$i];
            }
            else
            {
                $smallestOdd=$A[$i];
            }
        }

        if($s % 2!=0)
        {
            for(; $i<count($A); $i++)
            {
                if($lastEven==0 && $A[$i] % 2==0)
                {
                    $lastEven=$A[$i];
                }

                if($lastOdd==0 && $A[$i] % 2!=0)
                {
                    $lastOdd=$A[$i];
                }
            }

            if($smallestEven==0)
            {
                if($lastOdd==0) $s=-1;
                else $s=$s-$smallestEven+$lastOdd;
            }
            else if($lastEven==0 && $lastOdd==0) $s=-1;

            else if($lastEven==0) $s=$s-$smallestEven+$lastOdd;

            else if($lastOdd==0) $s=$s-$smallestOdd+$lastEven;

            else
            {
                if($lastOdd+$smallestEven>$lastEven+$smallestOdd) $s=$s-$smallestEven+$lastOdd;
                else $s=$s-$smallestOdd+$lastEven;
            }
        }

        dd($A, $K, $s);
    }

    public function functTest()
    {
        //that, given an array A of N integers, returns the smallest positive integer (greater than 0) that does not occur in A.
        //
        //For example, given A = [1, 3, 6, 4, 1, 2], the function should return 5.
        //
        //Given A = [1, 2, 3], the function should return 4.
        //
        //Given A = [−1, −3], the function should return 1.
        //
        //Write an efficient algorithm for the following assumptions:
        //
        //N is an integer within the range [1..100,000];
        //each element of array A is an integer within the range [−1,000,000..1,000,000].


        $elemArr = array_map(function () {
            return random_int(-1000000, 1000000);
        }, array_fill(0, 100000, null));


        $pi = $elemArr;
        $start = microtime(true);

        $minInt = 1;
        $resultInt = 1;

//        $pi = array_filter($elemArr, function ($value) {
//            return $value > 0;
//        });

       // sort($pi);

        if ($pi) {
            $j = count($pi);
            for ($i = 0; $i < $j + 1; $i++) {
//                if($i < $i+1) {
//
//                }
                $minItemKey = array_search($i + 1, $pi);

                if ($minItemKey === false) {
                    $resultInt = $i + 1;
                    break;
                }
                unset($pi[$minItemKey]);
            }

        }



        $end = microtime(true);
        $runtime = $end - $start;
        echo "Время выполнения php скрипта в микросекундах: ". $runtime;
        dd($resultInt);

        return view('test')->with(['res' => [$resultInt]]);

    }

}
