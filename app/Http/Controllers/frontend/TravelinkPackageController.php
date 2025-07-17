<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Benefit;
use App\Models\TravelinkPackage;
use App\Models\PackageRating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TravelinkPackageController extends Controller
{
    public function show($id)
    {
        $package = TravelinkPackage::findOrFail($id);
        return view('frontend.packagetravel.show', compact('package'));
    }
    // ...existing code...
    public function index()
    {
        $packages = \App\Models\TravelinkPackage::all();
        return view('frontend.packagetravel.index', compact('packages'));
    }

    public function club()
    {
        $travelinkPackages = TravelinkPackage::all(); // Ambil data paket dari database

        return view('frontend.club', compact('travelinkPackages'));
    }

    public function topDestinations()
    {
        $topDestinations = TravelinkPackage::all(); // Fetch all TravelinkPackage data
        return view('frontend.top_destinations', compact('topDestinations'));
    }

    public function topDeals()
    {
        $topDeals = TravelinkPackage::all(); // Fetch all TravelinkPackage data
        return view('frontend.top_deals', compact('topDeals'));
    }
}
