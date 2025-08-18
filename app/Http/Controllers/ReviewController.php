<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ReviewController extends Controller
{
   

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

        $review = new Review();
        $review->rating = $request->rating;
        $review->review = $request->review;
        $review->id_user = Auth::id();
        $review->save();

        return redirect()->route('dashboard')->with('success', 'Ulasan berhasil dikirim!');
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
        ]);


        return redirect()->route('dashboard')->with('success', 'Ulasan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $review = Review::find($id);

        if (!$review) {
            return redirect()->back()->with('gagal', 'Ulasan tidak ditemukan');
        }

        $review->delete();

        return redirect()->route('dashboard')->with('success', 'Ulasan berhasil dihapus!');
    }
}
