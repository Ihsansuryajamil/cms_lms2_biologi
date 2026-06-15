<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class DepanController extends Controller
{
    public function index()
    {
        // Menarik semua data course beserta nama pembuat dan jumlah babnya
        $courses = Course::with(['pembuat', 'topics'])->latest()->get();

        return view('homepage', compact('courses'));
    }
    public function show($id)
    {
        // Tarik data course, relasi pembuat, beserta topik dan sub-topik yang sudah diurutkan
        $course = Course::with([
            'pembuat',
            'topics' => function ($query) {
                $query->orderBy('urutan', 'asc');
            },
            'topics.subTopics' => function ($query) {
                // Menyaring sub-topik yang hanya berstatus 'publish' dan diurutkan secara asc
                $query->where('status', 'publish')
                      ->orderBy('urutan', 'asc');
            }
        ])->findOrFail($id); 

        return view('detail_course', compact('course'));
    }
}