<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



use App\Http\Controllers\authController;
use App\Http\Controllers\teamController;
use App\Http\Controllers\userController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\roomtypeController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\frontPageController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;



Route::controller(authController::class)->group(function () {

    Route::get('/auth','index')->name('login')->middleware('guest');
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

    Route::get('/auth/varify','varify')->name('auth.varify');

});// end group


Route::controller(dashboardController::class)->group(function () {

    Route::get('/dashboard','index')->name('dashboard')->middleware(['auth','verified']);


});//end group

Route::controller(userController::class)->group(function () {
   
    Route::get('/change_password','change_password')->name('user.change_password')->middleware(['auth','verified']);
    Route::post('/change_password/update','change_password_update')->name('user.change_password_update')->middleware(['auth','verified']);
    
    Route::get('/activity_log','activity_log')->name('user.activity_log')->middleware(['auth','verified','check_toyyip']);

    Route::get('/profile','index')->name('user.profile')->middleware(['auth']);
    
    Route::post('/user_update_profile','update_profile')->name('user.update.profile')->middleware('auth');
    Route::post('/user_remove_image','remove_image')->name('user.remove.image')->middleware('auth');
    Route::post('/user_update_image','update_image')->name('user.update.image')->middleware('auth');


});

Route::controller(teamController::class)->group(function () {

    Route::get('/all/team','index')->name('all.team')->middleware(['auth']);
    Route::get('/add/team','add')->name('add.team')->middleware(['auth']);
    Route::post('/store/team','store')->name('store.team')->middleware(['auth']);
    Route::get('/delete/team','destroy')->name('delete.team')->middleware(['auth']);
    Route::get('/edit/team/{id}','edit')->name('edit.team')->middleware(['auth']);
    Route::post('/update/team/{id}','update')->name('update.team')->middleware(['auth']);


});//end group

//book area 
Route::controller(teamController::class)->group(function () {
    Route::get('/book/area','book_area_edit')->name('book_area.edit')->middleware(['auth']);
    Route::post('/update/book_area/{id}','book_area_update')->name('update.book_area')->middleware(['auth']);
});//end group

//book area 
Route::controller(roomtypeController::class)->group(function () {
    Route::get('/roomtype','index')->name('roomtype')->middleware(['auth']);
    Route::get('/roomtype/create','create')->name('add.roomtype')->middleware(['auth']);
    Route::post('/roomtype/store','store')->name('store.roomtype')->middleware(['auth']);
});//end group

Route::controller(frontPageController::class)->group(function () {

    Route::get('/','index')->name('index')->middleware(['guest']);
});//end group




###############################################################################

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect(route('auth.varify'))->with('success','Your email has been successfully verified!');
})->middleware([ 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('success', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');



###############################################################################







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

