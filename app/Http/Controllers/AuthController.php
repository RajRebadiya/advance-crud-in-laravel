<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Illuminate\Support\Facades\Hash;




class AuthController extends Controller
{
    //
    public function register_show()
    {
        return view("register");
    }
    public function login_show()
    {
        return view("login");
    }
    public function register(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'password' => 'required|min:8|max:10',
            'cpassword' => 'required|same:password',
            'gender' => 'required',
            'hobby' => 'required|array',
            'city' => 'required',
            'image' => 'required|array'
        ]);
        // dd('jhjh')
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'gender' => $request->gender,
            'hobby' => implode(',', $request->hobby),
            'city' => $request->city,
            'image' => 'image.jpg'

        ]);
        if ($files = $request->file('image')) {
            $images = [];
            foreach ($files as $file) {
                $image_name = time() . '.' . $file->getClientOriginalName();
                $image_path = $file->storeAs('public/profile_image', $image_name);
                $images[] = $image_name;

            }
        }
        // Validate and store the original image
        // Create and store thumbnail
        // $thumbnailPaths = [];

        // foreach ($request->file('image') as $image) {
        //     $thumbnailPaths[] = $this->createThumbnail($image);
        // }
        $user->image = implode(',', $images);
        $user->update();
        return redirect()->route('login')->with('success', 'Registration Succesfull');
    }
    // private function createThumbnail($image)
    // {
    //     // Get file extension
    //     $extension = $image->getClientOriginalExtension();

    //     // Create image resource from file
    //     if ($extension == 'jpg' || $extension == 'jpeg') {
    //         $img = imagecreatefromjpeg($image->getPathname());
    //     } elseif ($extension == 'png') {
    //         $img = imagecreatefrompng($image->getPathname());
    //     } elseif ($extension == 'gif') {
    //         $img = imagecreatefromgif($image->getPathname());
    //     } else {
    //         throw new \Exception('Unsupported file format');
    //     }

    //     // Get image dimensions
    //     $width = imagesx($img);
    //     $height = imagesy($img);

    //     // Calculate thumbnail dimensions (example: 100x100)
    //     $newWidth = 100;
    //     $newHeight = 100;

    //     // Create a new true color image
    //     $thumbnail = imagecreatetruecolor($newWidth, $newHeight);

    //     // Resize and crop image to fit thumbnail dimensions
    //     imagecopyresampled($thumbnail, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    //     // Define storage path for thumbnail
    //     $thumbnailPath = 'public/thumbnails/' . $image->hashName();

    //     // Save thumbnail to storage
    //     if ($extension == 'jpg' || $extension == 'jpeg') {
    //         imagejpeg($thumbnail, storage_path('app/' . $thumbnailPath), 80); // Save JPEG with quality 80
    //     } elseif ($extension == 'png') {
    //         imagepng($thumbnail, storage_path('app/' . $thumbnailPath)); // Save PNG
    //     } elseif ($extension == 'gif') {
    //         imagegif($thumbnail, storage_path('app/' . $thumbnailPath)); // Save GIF
    //     }

    //     // Free up memory
    //     imagedestroy($img);
    //     imagedestroy($thumbnail);

    //     return $thumbnailPath;
    // }
    public function login(Request $request)
    {
        // dd($request->all());
        $user = Auth()->attempt(['email' => $request->email, 'password' => $request->password]);
        if ($user) {
            return redirect()->route('/')->with('success', 'Login Succesfull');
        } else {
            return redirect()->route('login')->with('error', 'Wrong Creditions');
        }
    }

    public function delete($id)
    {
        // dd($id);
        $user = User::where('id', $id)->delete();
        if ($user) {
            return redirect()->route('/')->with('success', 'User Deleted Succesfully');
        } else {
            return redirect()->route('/')->with('error', 'User Cant delete');
        }
    }

    public function edit_show($id)
    {
        $user = User::where('id', $id)->first();
        return view('edit', compact('user'));
    }
    public function edit(Request $request)
    {
        // dd($request->all());
        $user = User::where('id', $request->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->city = $request->city;
        $user->gender = $request->gender;
        $user->hobby = implode(',', $request->hobby);
        if ($files = $request->file('image')) {
            $images = [];
            foreach ($files as $file) {
                $image_name = time() . '.' . $file->getClientOriginalName();
                $image_path = $file->storeAs('public/profile_image/', $image_name);
                $images[] = $image_name;
            }

        } else {
            $images = explode(',', $user->image);
        }
        $user->image = implode(',', $images);

        $user->update();
        if ($user) {
            return redirect('/')->with('success', 'User Updated Succesfully');
        } else {
            return redirect('/')->with('error', 'User not update');
        }

    }
}
