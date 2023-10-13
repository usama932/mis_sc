<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
       
        return view('pages.dashboards.index');
    }
    public function frm_dashboard()
    {
       
        return view('pages.dashboards.frm_dashboard');
    }
    public function qb_dashboard()
    {
       
        return view('pages.dashboards.qb_dashboard');
    }
    public function medical_exit_interview()
    {
       
        return view('pages.dashboards.medical_exit_interview');
    }
}
