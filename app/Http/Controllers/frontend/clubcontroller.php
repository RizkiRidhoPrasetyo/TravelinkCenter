<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TravelinkPackage;

class ClubController extends Controller
{
    public function index(){
        $travelinkPackages = TravelinkPackage::all();

        // Query untuk promo yang akan berakhir dalam 28 hari menggunakan kolom expired_at
        $expiringPromos = TravelinkPackage::whereNotNull('promo_price')
            ->where('expired_at', '<=', now()->addDays(28))
            ->get();

        return view('frontend.club', compact('travelinkPackages', 'expiringPromos'));
    }
}
