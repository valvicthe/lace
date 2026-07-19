<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ShopController extends Controller
{
    public function store(Request $request)
    {
        // 1. Setup variables from the Request
        $name = $request->input('name');
        $description = $request->input('desc');
        $price = abs($request->input('price'));
        $assetid = abs($request->input('id'));
        $type = $request->input('type');
        $thumbnail = file_get_contents("http://renderservice.rainway.xyz/thumbnail.php?id=$assetid");
        $creator = Auth::user()->id;
        $adminstatus = Auth::user()->admin;

        // 2. Your existing validation logic
        $query = DB::table('shop')->where('robloxid', $assetid)->value('name');
        $q = DB::table('shop')->where('name', $name)->value('name');
        
        $supportedtypes = ["hat", "face", "shirt", "t-shirt", "pants"];
        $found = in_array($type, $supportedtypes);

        if (empty($query) && empty($q) && is_numeric($assetid) && $found && !empty($name) && !empty($description) && !empty($thumbnail) && $adminstatus == 1) {
            
            // [Keep your existing file upload logic here for $target_dir, move_uploaded_file, etc.]
            
            // 3. Insert into Database
            DB::table('shop')->insert([
                'name'        => $name, 
                'description' => $description,
                'price'       => $price, 
                'thumbnail'   => $thumbnail,
                'robloxid'    => $assetid,
                'onsale'      => 1,
                'creator'     => $creator,
                'type'        => $type
            ]);

            // 4. FIRE THE WEBHOOK
            $webhookUrl = env('DISCORD_SHOP_WEBHOOK');

            if ($webhookUrl) {
                Http::post($webhookUrl, [
                    'embeds' => [
                        [
                            'title' => '🛒 New Item Dropped!',
                            'description' => 'A new item was just added to the shop.',
                            'color' => 3900150, // The blue color
                            'fields' => [
                                ['name' => 'Item Name', 'value' => $name, 'inline' => true],
                                ['name' => 'Price', 'value' => $price, 'inline' => true],
                                ['name' => 'Uploaded By', 'value' => Auth::user()->name, 'inline' => true]
                            ]
                        ]
                    ]
                ]);
            }
        }

        return redirect('/shop');
    }
}
