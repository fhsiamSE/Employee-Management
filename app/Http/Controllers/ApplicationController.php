<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Mail\ApplicationRejected;
use Illuminate\Support\Facades\Mail;

class ApplicationController extends Controller
{
    // Public form
    public function createForm()
    {
        return Inertia::render('Public/ApplicationForm');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $path = $request->file('cv')->store('cvs', 'public');
        $data['cv_path'] = $path;
        $data['status'] = 'pending';

        Application::create($data);

        // Return JSON if AJAX request, otherwise redirect
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Application submitted successfully'], 201);
        }

        return redirect()->back()->with('success', 'Application submitted');
    }

    // Admin review (protected by 'auth' middleware in routes, role check optional with spatie)
    public function index()
    {
        // Check if user has hasRole method (spatie installed), otherwise allow any authenticated user
        $user = auth()->user();
        if (method_exists($user, 'hasRole') && ! $user->hasRole('admin')) {
            abort(403);
        }

        $applications = Application::orderBy('created_at', 'desc')->paginate(10);
        return Inertia::render('Applications/Index', ['applications' => $applications]);
    }

    public function show(Application $application)
    {
        $user = auth()->user();
        if (method_exists($user, 'hasRole') && ! $user->hasRole('admin')) {
            abort(403);
        }

        return Inertia::render('Applications/Show', ['application' => $application]);
    }

    public function approve(Application $application)
    {
        $user = auth()->user();
        if (method_exists($user, 'hasRole') && ! $user->hasRole('admin')) {
            abort(403);
        }

        $application->update(['status' => 'approved', 'processed_by' => $user->id, 'processed_at' => now()]);
        return redirect()->route('applications.index')->with('success', 'Application approved');
    }

    public function reject(Request $request, Application $application)
    {
        $user = auth()->user();
        if (method_exists($user, 'hasRole') && ! $user->hasRole('admin')) {
            abort(403);
        }

        $request->validate(['message' => 'nullable|string']);

        $application->update(['status' => 'rejected', 'processed_by' => $user->id, 'processed_at' => now(), 'notes' => $request->input('message')]);

        // Send rejection email
        Mail::to($application->email)->send(new ApplicationRejected($application, $request->input('message')));

        return redirect()->route('applications.index')->with('success', 'Application rejected and applicant notified');
    }
}
