<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Policies\Attendance as PoliciesAttendance;
use App\Policies\AttendancePolicy;
use Orion\Http\Controllers\Controller;
use Orion\Concerns\DisableAuthorization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orion\Concerns\DisablePagination;

class AttendanceController extends Controller
{
    //use DisableAuthorization;
    protected $model = Attendance::class;
    protected $policiy = AttendancePolicy::class;
    use DisablePagination;

    /**
     * Retrieves currently authenticated user based on the guard.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function resolveUser()
    {
        return Auth::guard('sanctum')->user();
    }


     /**
     * The attributes that are used for searching.
     *
     * @return array
     */
    public function searchableBy() : array
    {
        return ['user_genis_id'];
    }

     /**
     * The attributes that are used for sorting.
     *
     * @return array
     */
    public function sortableBy() : array
    {
         return ['date'];
    }

     /**
     * The attributes that are used for sorting.
     *
     * @return array
     */
    public function filterableBy() : array
    {
         return ['date'];
    }

    public function getAllData()
    {
        
        //$data = Attendance::paginate(20);
        $data = Attendance::select('attendances.*', 'user_genis.name as user_name')
        ->leftJoin('user_genis', 'attendances.user_genis_id', '=', 'user_genis.id')->orderBy('attendances.date', 'desc')
        ->paginate(20);
        return view('welcome', compact('data'));

    }
    



    // /**
    // * Default pagination limit.
    // *
    // * @return int
    // */
    // public function limit() : int
    // {
    //     return 100;
    // }

    // public function __construct(Request $request)
    // {   
    //     $rules = [
    //         'user_genis_id' => 'required|exists:user_genis,id',
    //         'date' => 'required|date',
    //         'status' => 'required|string|max:255',
    //         'reason' => 'nullable|string|max:255',
    //     ];
    //     dd($request->getContent());
    // }
}
