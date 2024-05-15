<?php

namespace App\Http\Controllers\Api\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Models\PengaduanCounts;
use App\Models\PengaduanStatus;
use App\Models\PengaduanCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    // DASHBOARD
    public function __invoke(Request $request)
    {
        // PENGADUAN
        $pengaduanCategories = PengaduanCategory::count();
        $pengaduanStatus = PengaduanStatus::count();
        $pengaduan = Pengaduan::count();


        // USERS
        $users = User::count();

        // GET 30 DAYS
        $pengaduanCounts = PengaduanCounts::select([
                // ID
                DB::raw('count(id) as `count`'),

                // DAY
                DB::raw('DATE(created_at) as day')

            // GROUP BY DAY
            ])->groupBy('day')

            // GET 30 DAY WITH CARBON
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->get();

        if(count($pengaduanCounts)) {
            foreach ($pengaduanCounts as $result) {
                $count[]   = (int) $result->count;
                $day[]     = $result->day;
            }
        }else {
            $count[] = "";
            $day[]  = "";
        }

        // RESPONSE JSON
        return response()->json([
            'success'   => true,
            'message'   => 'List Data on Dashboard',
            'data'      => [
                'categories' => $pengaduanCategories,
                'pengaduan'  => $pengaduan,
                'pengaduan_status' => $pengaduanStatus,
                'users'      => $users,
                'pengaduan_counts' => [
                    'count' => $count,
                    'days'   => $day
                ]
            ]
        ]);
    }

}
