<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Company;
use App\Internship;
use App\Person;
use App\Visitsstate;


class Dashboard extends Controller
{
    public function index($internshipId)
    {

        return view('dashboard/dashboard');
    }
}
