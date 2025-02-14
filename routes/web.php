<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\authController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\dashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(authController::class)->group(function () {

    Route::get('/auth','index')->name('auth')->middleware('guest');
    Route::post('/auth','login')->name('auth.login')->middleware(['guest']);

    Route::get('/auth/create','create')->name('auth.create')->middleware('guest');
    Route::post('/auth/store','store')->name('auth.store')->middleware('guest');

    Route::get('/auth/term_condition','term_condition')->name('auth.term.condition')->middleware('guest');

    Route::get('/logout','logout')->name('auth.logout');
    Route::get('/logout/page','logout_page')->name('auth.logout.page');

    Route::get('/forgot_password', 'forgot_password')->name('auth.forgot_password')->middleware('guest');
    Route::post('/forgot_password', 'forgot_password_email')->name('auth.forgot_password.email')->middleware('guest');

    Route::get('/reset-password/{token}','reset')->name('password.reset')->middleware('guest');
    Route::post('/reset-password','reset_password')->name('password.update')->middleware('guest');

});// end group


Route::controller(dashboardController::class)->group(function () {

    Route::get('/dashboard','index')->name('dashboard')->middleware(['auth']);


});//end group







Route::get('/auth/github/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('github-varify');
 
Route::get('/auth/github/callback', function () {
    $githubUser = Socialite::driver('github')->user();
 
    $existingUser = User::where('email', $githubUser->email)->first();
     //dd($existingUser->email);

    if ($existingUser) {

        $existingUser->github_id = $githubUser->id;
        $existingUser->github_token = $githubUser->token;
        $existingUser->save();

        // Log the user in if they already exist
        Auth::login($existingUser);
        
            return redirect('/dashboard');
    } else{
        //dd($githubUser);
        $user = new User;
        $user->name = $githubUser->nickname;
        $user->email = $githubUser->email;
        $user->github_id = $githubUser->id;
        $user->github_token = $githubUser->token;
        $user->save();

        $existingUser = User::where('email', $githubUser->email)->first();

        Auth::login($existingUser);
        
        return redirect('/dashboard');
    }
    return redirect(route('auth'))->with('error','accout or password is not exit');
});



Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('google-varify');
 
Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();
 
    $existingUser = User::where('email', $googleUser->email)->first();
    //dd($googleUser);

    if ($existingUser) {

        $existingUser->google_id = $googleUser->id;
        $existingUser->google_token = $googleUser->token;
        $existingUser->save();

        // Log the user in if they already exist
        Auth::login($existingUser);
        
            return redirect('/dashboard');
    } else{
                //dd($googleUser);
                $user = new User;
                $user->name = $googleUser->name;
                $user->email = $googleUser->email;
                $user->google_id = $googleUser->id;
                $user->google_token = $googleUser->token;
                $user->save();
        
                $existingUser = User::where('email', $googleUser->email)->first();
        
                Auth::login($existingUser);
                
                return redirect('/dashboard');
    }
    return redirect(route('auth'))->with('error','accout or password is not exit');
});




Route::get('/auth/linkedin/redirect', function () {
    return Socialite::driver('linkedin')->redirect();
});
 
Route::get('/auth/linkedin/callback', function () {
    $linkedinUser = Socialite::driver('linkedin')->user();
 
    $existingUser = User::where('email', $linkedinUser->email)->first();
     //dd($googleUser);

    if ($existingUser) {

        $existingUser->linkedin_id = $linkedinUser->id;
        $existingUser->linkedin_token = $linkedinUser->token;
        $existingUser->save();

        // Log the user in if they already exist
        Auth::login($existingUser);
        
            return redirect('/dashboard');
    } else{
            //dd($linkedinUser);
            $user = new User;
            $user->name = $linkedinUser->name;
            $user->email = $linkedinUser->email;
            $user->linkedin_id = $linkedinUser->id;
            $user->linkedin_token = $linkedinUser->token;
            $user->save();
    
            $existingUser = User::where('email', $linkedinUser->email)->first();
    
            Auth::login($existingUser);
            
            return redirect('/dashboard');
    }
    return redirect(route('auth'))->with('error','accout or password is not exit');
});

