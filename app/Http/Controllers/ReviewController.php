<?php

namespace App\Http\Controllers;

use App\Models\KataKotor;
use App\Models\Review;
use App\Models\User;
use App\Notifications\notifikasiTakedown;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::with('User')->latest();

        // Fitur pencarian
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('review', 'like', '%' . $searchTerm . '%');
        }

        if ($request->has('status')) {
            $status = $request->input('status') === 'approved' ? 'show' : 'hide';
            $query->where('status', $status);
        }

        // Fitur filter blacklist words
        if ($request->has('cek_kata')) {
            $kataKotor = KataKotor::pluck('kata')->toArray();

            $query->where(function ($q) use ($kataKotor) {
                foreach ($kataKotor as $word) {
                    $q->orWhere('review', 'like', '%' . $word . '%');
                }
            });
        }

        $reviews = $query->paginate(20);
        return view('admin.showReview', compact('reviews'));
    }

    // fungsi untuk menyimpan ulasan baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|between:1,5',
            'review' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Validasi gagal.');
        }

        // cek kata kotor
        $kataKotor = KataKotor::pluck('kata')->toArray();
        $kataKotorDitemukan = [];
        foreach ($kataKotor as $kata) {
            if (stripos($request->review, $kata) !== false) {
                $kataKotorDitemukan[] = $kata;
            }
        }

        $review = new Review();
        $review->rating = $request->rating;
        $review->review = $request->review;

        if (!empty($kataKotorDitemukan)) {
            $review->status = 'hide';

            // Kirim notifikasi ke admin
            $admin = User::where('role', 'admin')->first();
            $takedownNotif = [
                'kata' => $kataKotorDitemukan,
                'nama' => Auth::user()->nama,
                'id_review' => $review->id,
            ];
            Notification::send($admin, new notifikasiTakedown($takedownNotif));
        } else {
            $review->status = 'show';
        }
        $review->id_user = Auth::id();
        $review->save();

        $message = !empty($kataKotorDitemukan)
            ? 'Ulasan Anda mengandung kata tidak pantas dan sedang ditinjau admin'
            : 'Ulasan berhasil dikirim!';

        return redirect()->route('dashboard')->with('success', $message);
    }


    // fungsi untuk memperbarui ulasan
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $review = Review::find($id);

        if (!$review) {
            return redirect()->back()->with('gagal', 'Ulasan tidak ditemukan');
        }

        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|between:1,5',
            'review' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Validasi gagal.');
        }

        $review->update([
            'rating' => $request->rating,
            'review' => $request->review,
            'status' => 'hide',
        ]);


        return redirect()->route('dashboard')->with('success', 'Ulasan berhasil diperbarui!');
    }


    public function approve($id)
    {
        $review = Review::find($id);

        if (!$review) {
            return redirect()->back()->with('gagal', 'Ulasan tidak ditemukan');
        }

        $review->update([
            'status' => 'show',
        ]);

        return redirect()->route('admin.review')->with('success', 'Ulasan berhasil dihapus!');
    }

    public function destroy($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('gagal', 'Silakan login terlebih dahulu.');
        }

        if (Auth::user()->role === 'admin') {
            $review = Review::find($id);
        } else {
            $review = Review::where('id_user', auth()->user()->id_user)->find($id);
        }

        if (!$review) {
            return redirect()->back()->with('gagal', 'Ulasan tidak ditemukan atau Anda tidak memiliki akses.');
        }

        $review->delete();

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.review')->with('success', 'Ulasan berhasil dihapus!');
        }
        return redirect()->route('dashboard')->with('success', 'Ulasan berhasil dihapus!');
    }
}
