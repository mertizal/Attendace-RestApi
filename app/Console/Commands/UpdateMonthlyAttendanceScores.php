<?php

namespace App\Console\Commands;

use App\Models\Attendance;
use App\Models\MonthlyAttendanceScore;
use App\Models\UserGeni;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

class UpdateMonthlyAttendanceScores extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-monthly-attendance-scores';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("aylık puan hesaplama komutu başladı");
        $users = UserGeni::all();
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();
        $monthYear = $now->format('F Y');

        $progressBar = $this->output->createProgressBar($users->count());
        $progressBar->start();
        try {

            foreach($users as $user){

                $score=0;
                $monthlyAttendances = Attendance::where('user_genis_id', $user->id)
                                       ->whereBetween('date', [$startOfMonth, $endOfMonth])
                                       ->get();
    
                foreach($monthlyAttendances as $monthlyAttendance){
                    
                    if($monthlyAttendance->status == "present"){
    
                        $score=$score+10;
    
                    }
    
                    if($monthlyAttendance->status == "absent"){
    
                        $score=$score-10;
    
                    } 
                    
                }
                //$this->info($score);
                MonthlyAttendanceScore::create([
                    'user_genis_id' => $user->id,
                    'month' => $monthYear,
                    'score' => $score
                ]);
                $progressBar->advance();   
            }

        } catch (\Throwable $th) {
            Log::error("Aylık puan hesaplama sırasında hata oluştu: " . $th->getMessage());
        }
        $progressBar->finish();
        $this->info("aylık puan hesaplama komutu bitti");
    }
}
