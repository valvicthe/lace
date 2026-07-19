<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name'); }} - Profile</title>
    </head>
</html>

<x-app-layout>
    @if ($profileUser && $profileUser->status == 1)
        <div class="col d-flex justify-content-center" style="padding:10px;">
            <div class="card" style="width:420px;">
                <div class="card-body">
                    <div class="card-block text-center">
                        <p class="card-title font-weight-bold" style="font-size: 26px;">{{ $profileUser->name }}</p>
                        <img width="420" height="420" src="{{ $profileUser->avatar }}">
                        <p style="font-size: 20px;">{{ $profileUser->blurb }}</p>
                    </div>
                </div>
            </div>

            <!-- Fix: Used profileUser->id -->
            <form action="/friends/add/{{ $profileUser->id }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Add Friend
                </button>
            </form>

            <div class="card">
                <div class="card-body">
                    <div class="card-block text-center">
                        <p class="card-title font-weight-bold" style="font-size: 26px;">Places</p>
                        <p class="card-title font-weight-bold" style="font-size: 26px;">Not Implemented Yet!</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col d-flex justify-content-center" style="padding:10px;">
            <div class="card">
                <div class="card-body">
                    <p class="card-title font-weight-bold text-center" style="font-size: 26px;">Inventory</p>
                    
                    @if ($items->count() > 0)
                        <div class="row">
                            @foreach($items as $item)
                                <div class="col-md-4">
                                    <div class="card" style="width: 10rem;">
                                        @php $thumbnail = DB::table('shop')->where('itemid', $item->itemid)->value('thumbnail'); @endphp
                                        <a href="/item?id={{ $item->itemid }}"> 
                                            <img class="card-img-top" src="{{ $thumbnail }}"> 
                                        </a>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $item->itemname }}</h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            {{ $items->appends(['id' => $profileUser->id])->links() }}
                        </div>
                    @else
                        <p class="text-center">Items not found.</p>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="py-12 text-center">Player not found or account inactive.</div>
    @endif
</x-app-layout>
