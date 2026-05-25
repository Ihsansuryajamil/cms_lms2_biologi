<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    // 1. Menampilkan Semua Materi milik Guru tersebut
    public function index()
    {
        // Ambil kelas yang HANYA dibuat oleh guru yang sedang login
        $courses = Course::where('user_id', Auth::id())->latest()->get();
        
        return view('Dashboard.Guru.Course.course_all', compact('courses'));
    }

    // 2. Menampilkan Form Tambah Materi
    public function create()
    {
        return view('Dashboard.Guru.Course.course_tambah');
    }

    // 3. Menyimpan Materi ke Database
    public function store(Request $request)
    {
        // 1. Validasi Input (termasuk avatar)
        $request->validate([
            'nama_course' => 'required|string|max:150',
            'link_video'  => 'nullable|url|max:255',
            'deskripsi'   => 'required|string',
            'persyaratan' => 'nullable|string',
            'avatar'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10120', // Maks 10MB sebelum di-compress
        ]);

        $data = [
            'nama_course' => $request->nama_course,
            'user_id'     => Auth::id(),
            'kode_course' => strtoupper(Str::random(8)),
            'link_video'  => $request->link_video,
            'deskripsi'   => $request->deskripsi,
            'persyaratan' => $request->persyaratan ?? '-',
        ];

        // 2. Handle Upload & Compress Avatar
        if ($request->hasFile('avatar')) {
            // Path menggunakan public_path() standar Laravel
            $destinationPath = public_path('image/course/avatar');
            $file = $request->file('avatar');
            
            // Panggil helper kompresi
            $filename = $this->processImage($file, $destinationPath);
            $data['avatar'] = $filename; // Hanya simpan nama filenya di DB
        }

        // 3. Simpan ke Database
        Course::create($data);

        return redirect()->route('guru_course_all')->with('success', 'Materi berhasil ditambahkan!');
    }

    // 4. Menampilkan Detail 1 Materi (Beserta list Topic-nya nanti)
    public function show($id)
    {
        // Cari materi berdasarkan ID, jika tidak ada akan memunculkan 404
        // (Nantinya with('topics') akan berguna jika relasi topik sudah dibuat)
        $course = Course::findOrFail($id); 
        
        return view('Dashboard.Guru.Course.course_detail', compact('course'));
    }

    // =========================================================================
    // HELPER: Image Compression to WebP (Maks resolusi 854px)
    // =========================================================================
    private function processImage($file, $destinationPath)
    {
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $filename = uniqid() . '_' . Str::random(8) . '.webp';
        $extension = strtolower($file->getClientOriginalExtension());
        $img = null;

        try {
            switch ($extension) {
                case 'jpeg':
                case 'jpg':
                    $img = @imagecreatefromjpeg($file->getRealPath());
                    break;
                case 'png':
                    $img = @imagecreatefrompng($file->getRealPath());
                    if ($img) {
                        imagepalettetotruecolor($img);
                        imagealphablending($img, true);
                        imagesavealpha($img, false);
                    }
                    break;
                case 'webp':
                    $img = @imagecreatefromwebp($file->getRealPath());
                    break;
                default:
                    $string = file_get_contents($file->getRealPath());
                    $img = @imagecreatefromstring($string);
                    break;
            }
        } catch (\Exception $e) {
            return time() . '.webp'; 
        }

        if (!$img) {
            return time() . '.webp';
        }

        // Patokan 480p wide (16:9) -> Lebar 854px
        $maxWidth = 854; 
        $widthOrig = imagesx($img);
        $heightOrig = imagesy($img);

        if ($widthOrig > $maxWidth) {
            $ratio = $maxWidth / $widthOrig;
            $newWidth = $maxWidth;
            $newHeight = $heightOrig * $ratio;

            $newImg = imagecreatetruecolor($newWidth, $newHeight);
            imagealphablending($newImg, false);
            imagesavealpha($newImg, true);
            
            imagecopyresampled($newImg, $img, 0, 0, 0, 0, $newWidth, $newHeight, $widthOrig, $heightOrig);
            imagedestroy($img);
            $img = $newImg;     
        }

        imagewebp($img, $destinationPath . '/' . $filename, 75);
        imagedestroy($img);

        return $filename;
    }
}