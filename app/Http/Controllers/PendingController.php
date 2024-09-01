<?php

namespace App\Http\Controllers;

use App\Models\PendingAction;
use App\Models\UnitKerja;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class PendingController extends Controller
{
    /**
     * Display a listing of the pending updates.
     */
    public function pendingUpdates()
    {
        if (Auth::user()->role_id != 1) {
            return redirect()->back()->with('error', 'You do not have permission to view pending updates.');
        }
        $updates = PendingAction::getPendingActions('update');
        return view('pages.admin.pending-updates', compact('updates'));
    }

    /**
     * Display a listing of the pending deletes.
     */
    public function pendingDeletes()
    {
        if (Auth::user()->role_id != 1) {
            return redirect()->back()->with('error', 'You do not have permission to view pending deletes.');
        }

        $deletes = PendingAction::getPendingActions('delete');

        return view('pages.admin.pending-deletes', compact('deletes'));
    }

    /**
     * Approve a pending update.
     */
    public function verifyUpdate($id)
    {
        if (Auth::user()->role_id != 1) {
            return redirect()->route('home')->with('error', 'You do not have permission to verify updates.');
        }

        $updateData = PendingAction::getPendingAction('update', $id);

        if (!$updateData) {
            return redirect()->route('pending-updates')->with('error', 'Update request not found.');
        }

        $modelClass = '\\App\\Models\\' . $updateData['type'];
        $model = $modelClass::findOrFail($updateData['id']);
        $model->update($updateData['validated_data']);

        PendingAction::deletePendingAction('update', $id);

        return redirect()->back()->with('success', 'Update verified and applied successfully.');
    }

    /**
     * Approve a pending delete.
     */
    public function verifyDelete($id)
    {
        if (Auth::user()->role_id != 1) {
            return redirect()->route('home')->with('error', 'You do not have permission to verify deletes.');
        }

        $deleteData = PendingAction::getPendingAction('delete', $id);

        if (!$deleteData) {
            return redirect()->route('pending-deletes')->with('error', 'Delete request not found.');
        }

        $modelClass = '\\App\\Models\\' . $deleteData['type'];
        $modelClass::destroy($deleteData['id']);

        PendingAction::deletePendingAction('delete', $id);

        return redirect()->back()->with('success', 'Delete verified and applied successfully.');
    }

    /**
     * Reject a pending update.
     */
    public function rejectUpdate($id)
    {
        if (Auth::user()->role_id != 1) {
            return redirect()->route('home')->with('error', 'You do not have permission to reject updates.');
        }

        PendingAction::deletePendingAction('update', $id);

        return redirect()->back()->with('success', 'Update request rejected and deleted.');
    }

    /**
     * Reject a pending delete.
     */
    public function rejectDelete($id)
    {
        if (Auth::user()->role_id != 1) {
            return redirect()->route('home')->with('error', 'You do not have permission to reject deletes.');
        }

        PendingAction::deletePendingAction('delete', $id);

        return redirect()->back()->with('success', 'Delete request rejected and deleted.');
    }

    /**
     * Clean up old pending actions.
     * 
     * This method is called periodically to remove old pending actions from Redis.
     * 
     * @param string $actionType Type of action (e.g., 'update', 'delete')
     * @param int $days Number of days after which pending actions are considered old
     */
    public function cleanupOldPendingActions($actionType, $days = 30)
    {
        $keys = Redis::keys("kepegawaian_pending_{$actionType}:*");
        foreach ($keys as $key) {
            $actionData = json_decode(Redis::get($key), true);
            $requestedAt = Carbon::parse($actionData['requested_at']);

            // Remove actions older than the specified number of days
            if ($requestedAt->diffInDays(now()) > $days) {
                Redis::del($key);
            }
        }
    }
}
