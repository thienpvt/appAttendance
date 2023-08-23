<?php

namespace App\Http\Controllers;

use App\Models\Attendance_detail;
use App\Http\Requests\StoreAttendance_detailRequest;
use App\Http\Requests\UpdateAttendance_detailRequest;

class AttendanceDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAttendance_detailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttendance_detailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance_detail  $attendance_detail
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance_detail $attendance_detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance_detail  $attendance_detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance_detail $attendance_detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAttendance_detailRequest  $request
     * @param  \App\Models\Attendance_detail  $attendance_detail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAttendance_detailRequest $request, Attendance_detail $attendance_detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance_detail  $attendance_detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance_detail $attendance_detail)
    {
        //
    }
}
