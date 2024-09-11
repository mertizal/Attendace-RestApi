<?php

namespace App\Http\Controllers;

use App\Models\MonthlyAttendanceScore;
use Orion\Http\Controllers\Controller;
use Orion\Concerns\DisableAuthorization;
use Illuminate\Http\Request;


class MonthlyAttendanceScoreController extends Controller
{
    use DisableAuthorization;
    protected $model = MonthlyAttendanceScore::class;


    public function getAllData()
    {
        $data = MonthlyAttendanceScore::select('monthly_attendance_scores.*', 'user_genis.name as user_name')
        ->leftJoin('user_genis', 'monthly_attendance_scores.user_genis_id', '=', 'user_genis.id')->orderBy('monthly_attendance_scores.score', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(20);
        return view('aylik', compact('data'));

    }
}
