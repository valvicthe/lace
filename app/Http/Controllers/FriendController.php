namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function sendRequest($friendId)
    {
        // Prevent adding yourself
        if ($friendId == Auth::id()) {
            return back()->with('error', 'You cannot add yourself!');
        }

        $exists = DB::table('friendships')
            ->where('user_id', Auth::id())
            ->where('friend_id', $friendId)
            ->exists();

        if (!$exists) {
            DB::table('friendships')->insert([
                'user_id' => Auth::id(),
                'friend_id' => $friendId,
                'status' => 'pending'
            ]);
            return back()->with('success', 'Friend request sent!');
        }

        return back()->with('error', 'Request already sent.');
    }
}
