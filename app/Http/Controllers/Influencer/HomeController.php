<?php

namespace App\Http\Controllers\Influencer;

use App\Http\Controllers\Controller;
use App\Models\Influencer;
use App\Models\CustomerCourse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard(Request $request)
    {
        $influencer = auth('influencer')->user();

        $myReview = starRatingsCalculator(Influencer::class, $influencer->id);

        // $courses = $influencer->courses()->count();

        // $appointments = $influencer->appointments()->count();

        // $students = CustomerCourse::whereIn('course_id', $influencer->courses()->pluck('id')->toArray())->count();

        return view('backend-influencer.dashboard', compact('myReview', 'influencer'));
    }
}
