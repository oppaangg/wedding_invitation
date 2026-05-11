<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GuestController extends Controller
{
    // Admin: list all guests
    public function index()
    {
        $guests = Guest::orderBy('created_at', 'desc')->get();
        $stats = [
            'total'     => $guests->count(),
            'confirmed' => $guests->where('is_confirmed', true)->count(),
            'opened'    => $guests->whereNotNull('opened_at')->count(),
            'total_pax' => $guests->where('is_confirmed', true)->sum('guest_count'),
        ];
        return view('admin.guests.index', compact('guests', 'stats'));
    }

    // Admin: show create form
    public function create()
    {
        return view('admin.guests.create');
    }

    // Admin: store new guest
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'phone'    => 'nullable|string|max:20',
            'category' => 'required|in:family,friend,colleague,other',
        ]);
        $validated['slug'] = Str::slug($validated['name']) . '-' . Str::random(5);
        Guest::create($validated);
        return redirect()->route('admin.guests.index')
            ->with('success', 'Tamu berhasil ditambahkan!');
    }

    // Admin: edit form
    public function edit(Guest $guest)
    {
        return view('admin.guests.edit', compact('guest'));
    }

    // Admin: update guest
    public function update(Request $request, Guest $guest)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'phone'    => 'nullable|string|max:20',
            'category' => 'required|in:family,friend,colleague,other',
        ]);
        $guest->update($validated);
        return redirect()->route('admin.guests.index')
            ->with('success', 'Data tamu berhasil diperbarui!');
    }

    // Admin: delete guest
    public function destroy(Guest $guest)
    {
        $guest->delete();
        return redirect()->route('admin.guests.index')
            ->with('success', 'Tamu berhasil dihapus!');
    }

    // Admin: bulk import via text
    public function bulkStore(Request $request)
    {
        $request->validate(['names' => 'required|string']);
        $names = array_filter(array_map('trim', explode("\n", $request->names)));
        $count = 0;
        foreach ($names as $name) {
            if (!empty($name)) {
                Guest::create([
                    'name'     => $name,
                    'slug'     => Str::slug($name) . '-' . Str::random(5),
                    'category' => $request->get('category', 'friend'),
                ]);
                $count++;
            }
        }
        return redirect()->route('admin.guests.index')
            ->with('success', "$count tamu berhasil ditambahkan!");
    }

    // Public: show invitation for specific guest
    public function invitation(string $slug)
    {
        $guest = Guest::where('slug', $slug)->firstOrFail();
        if (!$guest->opened_at) {
            $guest->update(['opened_at' => now()]);
        }
        return view('invitation', compact('guest'));
    }

    // Public: RSVP confirmation
    public function rsvp(Request $request, string $slug)
    {
        $guest = Guest::where('slug', $slug)->firstOrFail();
        $validated = $request->validate([
            'is_confirmed' => 'required|boolean',
            'guest_count'  => 'required|integer|min:1|max:10',
            'message'      => 'nullable|string|max:1000',
        ]);
        $guest->update($validated);
        return response()->json(['success' => true, 'message' => 'Konfirmasi berhasil!']);
    }

    // Public: general invitation (no specific guest)
    public function general()
    {
        return view('invitation', ['guest' => null]);
    }
}
