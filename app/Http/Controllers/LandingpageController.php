<?php

namespace App\Http\Controllers;

use App\Models\Aboutme;
use App\Models\Admin;
use App\Models\Announcement;
use App\Models\Cooperation;
use App\Models\Facility;
use App\Models\Footer;
use App\Models\Greeting;
use App\Models\History;
use App\Models\Lecture;
use App\Models\News;
use App\Models\Rektor;
use App\Models\Student;
use App\Models\Visimisi;

class LandingpageController extends Controller
{
    /**
     * Halaman utama — kumpulkan data ringan untuk hero, sambutan,
     * fasilitas, kerja sama, visi & misi, dan pimpinan.
     */
    public function index()
    {
        $cooperations = Cooperation::all();
        $greeting     = Greeting::first();
        $facilities   = Facility::all();
        $visimisi     = Visimisi::first();
        $rektors      = Rektor::orderBy('id', 'asc')->get();
        $aboutme      = Aboutme::first();
        $footer = Footer::query()->first();

        $latestNews          = News::with('user')->latest()->paginate(3);
        $latestAnnouncements = Announcement::with('user')->latest()->paginate(3);

        return view('landingpage', compact(
            'cooperations',
            'greeting',
            'facilities',
            'visimisi',
            'rektors',
            'aboutme',
            'footer',
            'latestNews',
            'latestAnnouncements'
        ));
    }

    /**
     * Halaman daftar dosen.
     */
    public function lectures()
    {
        $lectures = Lecture::orderBy('nama', 'asc')->paginate(9);
        $footer = Footer::query()->first();

        return view('lectures', compact('lectures', 'footer'));
    }

    /**
     * Halaman profil universitas (gabungan: profil, sejarah, visi misi, pimpinan, staf).
     */
    public function profile()
    {
        $aboutme  = Aboutme::first();
        $history  = History::first();
        $visimisi = Visimisi::first();
        $rektors  = Rektor::orderBy('id', 'asc')->get();
        $admins   = Admin::orderBy('nama', 'asc')->get();
        $footer = Footer::query()->first();

        return view('profile', compact(
            'aboutme',
            'history',
            'visimisi',
            'rektors',
            'admins',
            'footer'
        ));
    }

    /**
     * Halaman daftar pengumuman.
     */
    public function announcements()
    {
        $announcements = Announcement::with('user')->latest()->paginate(6);
        $footer = Footer::query()->first();

        return view('announcements', compact('announcements', 'footer'));
    }

    /**
     * Halaman daftar berita.
     */
    public function news()
    {
        $news   = News::with('user')->latest()->paginate(6);
        $footer = Footer::query()->first();

        return view('news', compact('news', 'footer'));
    }

    /**
     * Halaman daftar mahasiswa.
     */
    public function students()
    {
        $students = Student::orderBy('namalengkap', 'asc')->paginate(12);
        $footer = Footer::query()->first();

        return view('students', compact('students', 'footer'));
    }
}