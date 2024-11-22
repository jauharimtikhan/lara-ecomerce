<?php

use App\Http\Controllers\MidtransWebhookController;
use App\Http\Controllers\TesController;
use App\Models\CuratorMedia;
use App\Models\Role;
// use App\Models\Cart;
use App\Models\User;
use Cloudinary\Api\Upload\UploadApi;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Modules\Admin\App\Livewire\Logout;
use Illuminate\Support\Str;

use function Modules\Frontend\Helpers\module_path;
use function Modules\Frontend\Helpers\to_json;

Route::get('/update/geologi_indonesia', [TesController::class, 'index'])->middleware('web');
Route::get('/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
})->middleware('guest')->name('auth.redirect');
Route::get('/login', function () {
    return to_route('frontend.login');
});
Route::get('/auth/callback', function () {
    $google = Socialite::driver('google')->user();
    $user = User::updateOrCreate([
        'email' => $google->getEmail(),
    ], [
        'email' => $google->getEmail(),
        'password' => Hash::make($google->getId()),
        'name' => $google->getName()
    ]);
    $memberRoleId = Role::where('name', 'member')->first()->uuid;
    $user->roles()->syncWithoutDetaching([$memberRoleId]);

    Auth::login($user);

    return to_route('frontend.home');
})->middleware('guest')->name('auth.callback');
Route::get('/', \Modules\Frontend\App\Livewire\Home::class)->name('home');
Route::prefix('membership')->group(function () {
    $components = glob(module_path('Frontend') . '/app/Livewire/*.php');
    foreach ($components as $component) {
        $file = basename($component, '.php');
        $class = "Modules\\Frontend\\App\\Livewire\\{$file}";
        $uri = strtolower($file);
        $reflection = new ReflectionClass($class);
        if ($reflection->hasProperty('middleware')) {
            if (is_array($reflection->getStaticPropertyValue('middleware'))) {
                $middleware = $reflection->getStaticPropertyValue('middleware');
            }

            if (is_string($reflection->getStaticPropertyValue('middleware'))) {
                $middleware = $reflection->getStaticPropertyValue('middleware');
            }
        }
        Route::get("/{$uri}", $class)->name("frontend.{$uri}")->middleware($middleware ?? null);
    }
    Route::get("/logout", function () {
        Auth::logout();
        return to_route('frontend.login');
    })->name('frontend.logout');
});

Route::get('/erase/cart', function () {
    try {
        Cart::destroy();
        Cart::instance('default')->erase(Auth::user()->getAuthIdentifier());
        // dd($cart);
        // dd(event('cart.erased'));
        return response()->json([
            'message' => 'success',
        ], 200);
    } catch (\Exception $th) {
        return response()->json([
            'message' => $th->getMessage(),
        ], 500);
    }
});

Route::post('/midtrans/webhook', [MidtransWebhookController::class, 'handle'])
    ->middleware('web')
    ->name('midtrans.webhook');

Route::post('/midtrans/get_status', [MidtransWebhookController::class, 'getStatus'])
    ->middleware('web')
    ->name('midtrans.status');

Route::get('/media-data-list', function () {
    $media = CuratorMedia::paginate(10);
    return to_json([
        'data' => $media->items(),
        'links' => $media->linkCollection()
    ], 200);
})->name('media.data.list');

Route::get('/media-data-get-first/{id}', function ($id) {
    try {
        $media = CuratorMedia::find($id);
        return to_json([
            'data' => $media,
        ], 200);
    } catch (\Exception $th) {
        return to_json([
            'error' => $th->getMessage(),
            'message' => 'Gagal mendapatkan data media',
        ], 500);
        //throw $th;
    }
})->name('media.data.getbyid');

Route::post('/media-data-upload', function (Request $request) {
    if (empty($request->file('file'))) {
        return to_json([
            'errors' => 'Tidak Ada File Yang Dipilih!'
        ], 422);
    }
    if ($request->hasFile('file')) {

        $files = $request->file('file');
        foreach ($files as $file) {
            $ext = Str::replace('image/', '', $file->getClientMimeType());
            $type = $file->getClientMimeType();
            $disk = 'cloudinary';
            $directory = 'media';
            $pubId = Str::uuid();
            $filename = "{$pubId}.{$ext}";
            $visibility = 'public';
            $path = "{$directory}/$filename";
            $title = $file->getClientOriginalName();
            try {
                $cloudinary = Cloudinary::upload($file, [
                    'resource_type' => 'image',
                    'folder' => 'media',
                    'public_id' => "{$pubId}"
                ])->getSecurePath();
                CuratorMedia::create([
                    'name' => $filename,
                    'title' => $title,
                    'path' => $path,
                    'disk' => $disk,
                    'directory' => $directory,
                    'visibility' => $visibility,
                    'type' => $type,
                    'ext' => $ext
                ]);
                return to_json([
                    'url' => [$cloudinary],
                    'message' => 'File Berhasil Diunggah!'
                ], 200);
            } catch (\Exception $th) {
                return to_json([
                    'message' => 'File Gagal Diunggah!'
                ], 500);
            }
        }
    }

    // $file = $request->file('media_upload');
    // $rows = is_string($request->media) ? explode(',', $request->media) : $request->media;
})->name('media.data.upload');

require_once dirname(__DIR__) . "/Modules/Admin/routes/admin-routes.php";
