<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function history()
    {
        $user = auth()->user();
        $bookings = \App\Models\Booking::with('package')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('frontend.booking_history', compact('bookings'));
    }
    public function create($packageId)
    {
        $package = \App\Models\TravelinkPackage::find($packageId);
        return view('frontend.booking_form', [
            'package_id' => $packageId,
            'package' => $package
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits_between:8,15',
            'date' => 'required|date',
            'package_id' => 'required|integer',
        ]);

        // Cek kuota booking dan kurangi kuota secara atomik
        DB::beginTransaction();
        try {
            $package = \App\Models\TravelinkPackage::where('id', $request->package_id)->lockForUpdate()->first();
            if (!$package) {
                DB::rollBack();
                return redirect()->back()->with('canceled', 'Paket wisata tidak ditemukan.');
            }
            if ($package->max_quota <= 0) {
                DB::rollBack();
                return redirect()->back()->with('canceled', 'Kuota booking untuk wisata ini sudah habis.');
            }
            $booking = \App\Models\Booking::create([
                'user_id' => auth()->check() ? auth()->id() : null,
                'package_id' => $request->package_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'date' => $request->date,
                'notes' => $request->notes,
            ]);
            // Kurangi kuota maksimal
            $package->decrement('max_quota');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('canceled', 'Terjadi kesalahan saat booking. Silakan coba lagi.');
        }

        return redirect()->route('booking.create', $request->package_id)->with('success', 'Booking berhasil!');
    }

    public function index()
    {
        $bookings = \App\Models\Booking::with(['user', 'package'])->latest()->get();
        return view('admin.booking_index', compact('bookings'));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $booking = \App\Models\Booking::findOrFail($id);
            $package = \App\Models\TravelinkPackage::where('id', $booking->package_id)->lockForUpdate()->first();
            if ($package) {
                $package->increment('max_quota');
            }
            $booking->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Booking berhasil dihapus dan kuota dikembalikan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('canceled', 'Gagal menghapus booking.');
        }
    }
}
