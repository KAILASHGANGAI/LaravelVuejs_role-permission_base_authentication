<?php

namespace App\Http\Controllers\api;

use App\Events\NoticeEvent;
use App\Events\SendMessageToClientEvent;
use App\Events\TestingEvent;
use App\Http\Controllers\Controller;
use App\Models\notices;
use App\Models\User;
use App\Notifications\NoticeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Intervention\Image\ImageManagerStatic as Image;

class NoticesController extends Controller
{
    public function index()
    {
        $data = notices::all();

        return response()->json($data);
    }

    public function store(Request $req)
    {

        $new = new notices();
        $new->heading = $req->heading;
        $new->description = $req->description;
        if ($req->image) {
            $position = strpos($req->image, ';');
            $sub = substr($req->image, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time() . '.' . $ext;
            $img = Image::make($req->image)->resize(240, 240);
            $upload_path = 'images/notices/';
            $image_url = $upload_path . $name;

            if ($img->save($image_url)) {
                $new->image = $image_url;
            }
        }

        if ($new->save()) {
            $notice = $new->id;
            $user_sender = auth()->user();
            // broadcast(new NoticeNotification($user_sender, $notice))->toOthers();

            // Notification::send(User::all(), new NoticeNotification($user_sender, $notice));
            foreach (User::all() as $user) {
                $user->notify(new NoticeNotification($user_sender, $notice));
            }
            return response()->json([
                'status' => 'notices added successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'notices Not added successfully',
            ]);
        }
    }

    public function edit($id)
    {
        $data = notices::find($id);

        return response()->json($data);
    }

    public function update(Request $req, $id)
    {
        $update = notices::find($id);
        $update->heading = $req->heading;

        $update->description = $req->description;
        if ($req->image != $update->image) {
            $position = strpos($req->image, ';');
            $sub = substr($req->image, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time() . '.' . $ext;
            $img = Image::make($req->image)->resize(240, 240);
            $upload_path = 'images/notices/';
            $image_url = $upload_path . $name;
            if (isset($update->image)) {
                unlink($update->image);
            }
            if ($img->save($image_url)) {
                $update->image = $image_url;
            }
        }
        if ($update->save()) {
            return response()->json([
                'status' => 'notices updated successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'notices Not updated successfully',
            ]);
        }
    }

    public function delete($id)
    {
        $data = notices::find($id);
        if (isset($data->image)) {
            unlink($data->image);
        }
        if ($data->delete()) {
            return response()->json([
                'status' => 'notices deleted successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'notices not deleted',
            ]);
        }
    }
}
