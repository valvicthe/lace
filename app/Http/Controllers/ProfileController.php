// app/Http/Controllers/ProfileController.php

public function show(Request $request)
{
    $id = $request->query('id');
    
    // Fetch the user object properly
    $profileUser = User::where('id', $id)
                       ->whereNotNull('email_verified_at')
                       ->first();

    $items = [];
    if ($profileUser) {
        $items = DB::table('owneditems')
            ->where('user', $profileUser->id)
            ->paginate(3);
    }

    return view('profile', compact('profileUser', 'items'));
}
