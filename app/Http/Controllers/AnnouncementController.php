<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends \Illuminate\Routing\Controller
{
    // Get all announcements
    public function getAllAnnouncements()
    {
        $announcements = Announcement::all();
        return response()->json($announcements);
    }

    // Get an announcement by ID
    public function getAnnouncementById($id)
    {
        $announcement = Announcement::find($id);

        if ($announcement) {
            return response()->json($announcement);
        } else {
            return response()->json(['message' => 'Announcement not found'], 404);
        }
    }

    // Create a new announcement
    public function createAnnouncement(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
            'ann_exp' => 'required|date',
        ]);

        $announcement = Announcement::create($validated);
        return response()->json($announcement, 201);
    }

    // Update an existing announcement
    public function updateAnnouncement(Request $request, $id)
    {
        $announcement = Announcement::find($id);

        if ($announcement) {
            $validated = $request->validate([
                'message' => 'nullable|string|max:255',
                'ann_exp' => 'nullable|date',
            ]);

            $announcement->update($validated);
            return response()->json($announcement);
        } else {
            return response()->json(['message' => 'Announcement not found'], 404);
        }
    }

    // Delete an announcement
    public function deleteAnnouncement($id)
    {
        $announcement = Announcement::find($id);

        if ($announcement) {
            $announcement->delete();
            return response()->json(['message' => 'Announcement deleted successfully']);
        } else {
            return response()->json(['message' => 'Announcement not found'], 404);
        }
    }
}
