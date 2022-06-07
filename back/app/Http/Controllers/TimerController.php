<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Timer;
use App\Models\Employee;

class TimerController extends Controller
{
    public function checkIn(Request $request, $employeeId) {
        $employee = Employee::findOrFail($employeeId);

        $timer = new Timer;
        $timer->checkIn = Carbon::now()->format('Y-m-d H:i:s');
        $timer->comment = $request->input('comment');
        $timer->employee()->associate($employee);
        $timer->save();

        return response($timer, 201);
    }

    public function checkOut(Request $request, $employeeId) {
        $employee = Employee::findOrFail($employeeId);

        $timer = $employee->timers()->orderBy('checkIn', 'desc')->first();

        if (!$timer) {
            return response(['error' => 'Timer not found'], 404);
        }

        $now = Carbon::now();

        $employee_last_check_in = Carbon::parse($timer->checkIn);

        $employee_max_check_out = Carbon::parse($timer->checkIn);
        $employee_max_check_out->hour = 23;
        $employee_max_check_out->minute = 0;
        $employee_max_check_out->second = 0;

        if ($now->gt($employee_max_check_out)) {
            $timer->checkOut = $employee_max_check_out->format('Y-m-d H:i:s');
        } else {
            $timer->checkOut = $now->format('Y-m-d H:i:s');
        }

        $timer->dailyVolumeInHours = $employee_last_check_in->floatDiffInHours($now);
        $timer->comment = $request->input('comment');
        $timer->save();

        return $timer;
    }
}
