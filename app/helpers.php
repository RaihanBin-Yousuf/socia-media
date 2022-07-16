<?php

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;


function uploadFile($file, $folder = '/'): ?string
{
    // dd($file);

    if ($file) {
        $image_name = Rand() . '.' . $file->getClientOriginalExtension();
        return $file->storeAs($folder, $image_name, 'public');
    }
    return null;
}

function setImage($url = null, $type = null, $default_image = true): string
{
    if ($type == 'user') {
        return ($url != null) ? asset('storage/' . $url) : ($default_image ? asset('default/default_user.jpg') : '');
    }
    return ($url != null) ? asset('storage/' . $url) : ($default_image ? asset('default/default_image.jpg') : '');
}

// function setImage($url = null, $default_image = true): string
// {
//     return ($url != null) ? asset('storage/' . $url) : ($default_image ? asset('default/default_user.jpg') : '');
// }

// function setImagepost($url = null, $default_image = true): string
// { 
//     return ($url != null) ? asset('storage/' . $url) : ($default_image ? asset('default/default_image.jpg') : '');
// }

function dateFormat(Carbon $carbon): string
{
    return (new Controller())->dateFormat($carbon);
}


// function company(): CompanySetting
// {
//     return CompanySetting::first();
// }

function increment($data)
{
    return $data+1;
}

// function playerPosition($position)
// {
//     if($position == Player::BATSMAN) return 'batsman';
//     else if ($position == Player::BOWLER) return'bowler';
//     else if ($position == Player::WICKETKEEPER) return 'wicket keeper';
//     else return 'all rounder';
// }


function deleteFile($data_image = null)
{
    return unlink(public_path().'/storage/'.$data_image);
}

function updateFile($new_image = null, $folder = '/', $old_image =null)
{
    if($old_image == null) {
        // $image_name = Rand() . '.' . $new_image->getClientOriginalExtension();
        $image_name = $new_image->getClientOriginalName();
        return $new_image->storeAs($folder, $image_name, 'public');
    }
    if($new_image != $old_image) {
        // dd($new_image->getClientOriginalName());
        unlink(public_path().'/storage/'.$old_image);
        // $image_name = Rand() . '.' . $new_image->getClientOriginalExtension();
        $image_name = $new_image->getClientOriginalName();
        return $new_image->storeAs($folder, $image_name, 'public');
    }
    return $old_image;
}


function setDateTime($dateTime)
{
    return date('d-m-Y h:i', strtotime($dateTime));
}
