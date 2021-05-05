<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class FreportController extends Controller
{
    public function index(Request $request)
    {
        $start_of_date = Carbon::now()->startOfMonth();
        $end_of_date = Carbon::now()->lastOfMonth();

        $reports =  my_comp()->ticket()->select(
            \DB::raw('sum(price) as sums'),
            \DB::raw("DATE_FORMAT(created_at,'%Y/%m/%d') as date")
        )
            ->groupBy('date')
            ->pluck("sums", "date");

        $freports = [];
        $total_income = 0;
        $period = CarbonPeriod::create($start_of_date, '1 day', $end_of_date);
        foreach ($period as $p) {
            $date = $p->format('Y/m/d');
            $freports[$date] = 0;
            if (isset($reports[$date])) {
                $freports[$date] = $reports[$date];
                $total_income += $reports[$date];
            }
        }
        return view("freport.index", compact("freports", "total_income"));
    }
}
