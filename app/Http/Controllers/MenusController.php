<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class MenusController extends Controller
{
    public function index(){
        return view('admin.showMenus');
    }

    public function showFormStore(){
        $menus = Menu::whereNull('parent_menu')->orderBy('id_menus')->get();
        return view('admin.formMenus', compact('menus'));
    }

    public function showFormEdit($id){
        $menus = Menu::whereNull('parent_menu')->orderBy('id_menus')->get();
        $menu = Menu::with('parent')->findOrFail($id);
        return view('admin.formMenus', compact('menus', 'menu'));
    }

    public function getDataTables(Request $request)
    {
        if (!$request->ajax()) {
            return abort(403, 'Akses tidak diizinkan');
        }

        $menus = Menu::select(['id_menus', 'title', 'status'])->orderBy('updated_at', 'desc');

        return DataTables::of($menus)
            ->addColumn('aksi', function ($row) {
                return '
                <button class="editBtn bg-blue-500 text-white px-2 py-1 rounded text-sm" data-id="' . e($row->id_menus) . '">Edit</button>
                <button class="deleteBtn bg-red-500 text-white px-2 py-1 rounded text-sm ml-2" data-id="' . e($row->id_menus) . '">Hapus</button>
            ';
            })
            ->editColumn('status', function ($row) {
                return $row->status;
            })
            ->editColumn('title', function ($row) {
                return $row->title;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // mengirim data untuk membuat berita
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:50',
            'url' => 'nullable|string|max:255',
            'parent_menu' => 'nullable|string|max:2',
            'status' => 'required|in:show,hide',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Validasi gagal.');
        }

        $data = $validator->validated();
        
        if ($request->has('parent_menu')) {
            $data['parent_menu'] = $request->parent_menu;
        }

        if($request->has('url')){
            $data['url'] = $request->url;
        }

        Menu::create($data);

        return redirect()->route('admin.menus')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);

        if(!$menu){
            return redirect()->back()->with('gagal', 'menu tidak ditemukan');
        }
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:50',
            'url' => 'nullable|string|max:255',
            'parent_menu' => 'nullable|string|max:2',
            'status' => 'required|in:show,hide',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Validasi gagal.');
        }

        $data = $validator->validated();
        
        if ($request->has('parent_menu')) {
            $data['parent_menu'] = $request->parent_menu;
        }

        if($request->has('url')){
            $data['url'] = $request->url;
        }

        $menu->update($data);

        return redirect()->route('admin.menus')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function destroy($id){
        $menu = Menu::find($id);

        if(!$menu){
            return redirect()->back()->with('gagal', 'menu tidak ditemukan');
        }
        
        $menu->delete();
        return redirect()->back()->with('sukses', 'menu berhasil dihapus');
    }
}