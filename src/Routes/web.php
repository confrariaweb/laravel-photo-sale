<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;

use ConfrariaWeb\PhotoSale\Controllers\AuthController;
use ConfrariaWeb\PhotoSale\Controllers\CheckoutController;
use ConfrariaWeb\PhotoSale\Controllers\SocialiteController;
use ConfrariaWeb\PhotoSale\Controllers\PhotoController;
use ConfrariaWeb\PhotoSale\Controllers\UserController;

use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])
    ->namespace('ConfrariaWeb\PhotoSale\Controllers')
    ->group(function () {
        Route::get('/', [PhotoController::class, 'index'])->name('photos.index');
        Route::get('dashboard', [PhotoController::class, 'index'])->name('dashboard');

        Route::get('/photos/{driver}/json', [PhotoController::class, 'photoDriverJson'])->name('photo.driver.json');
        Route::post('/photos/save/ajax', [PhotoController::class, 'photoSaveAjax'])->name('photo.save.ajax');
        Route::post('/photos/preferred/ajax', [PhotoController::class, 'photoPreferred'])->name('photo.preferred.ajax');

        Route::resource('users', 'UserController');
        Route::get('profile', [UserController::class, 'profile'])->name('users.profile');
        Route::get('payment/information', [UserController::class, 'paymentInformation'])->name('users.payment.information');
        Route::post('users/creditcard/tokenize/ajax', [UserController::class, 'tokenizeCardAjax'])->name('users.tokenizecard.ajax');

        Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
        Route::post('checkout/store/ajax', [CheckoutController::class, 'storeAjax'])->name('checkout.store.ajax');

        Route::resource('orders', 'OrderController');

        Route::resource('creditcards', 'CreditCardController');
    });

Route::middleware(['web'])
    ->group(function () {
        Route::get('/auth/{driver}/redirect', [SocialiteController::class, 'redirect'])->name('socialite.redirect');
        Route::get('/auth/{driver}/callback', [SocialiteController::class, 'callback'])->name('socialite.callback');

        Route::get('/register', [RegisteredUserController::class, 'create'])
            ->middleware('guest')
            ->name('register');

        Route::post('/register', [RegisteredUserController::class, 'store'])
            ->middleware('guest');

        Route::get('/login', [AuthController::class, 'create'])
            ->middleware('guest')
            ->name('login');
        /*Route::get('/login', [AuthenticatedSessionController::class, 'create'])
            ->middleware('guest')
            ->name('login');*/

        Route::post('/login', [AuthenticatedSessionController::class, 'store'])
            ->middleware('guest');

        Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
            ->middleware('guest')
            ->name('password.request');

        Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
            ->middleware('guest')
            ->name('password.email');

        Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
            ->middleware('guest')
            ->name('password.reset');

        Route::post('/reset-password', [NewPasswordController::class, 'store'])
            ->middleware('guest')
            ->name('password.update');

        Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
            ->middleware('auth')
            ->name('verification.notice');

        Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
            ->middleware(['auth', 'signed', 'throttle:6,1'])
            ->name('verification.verify');

        Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware(['auth', 'throttle:6,1'])
            ->name('verification.send');

        Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
            ->middleware('auth')
            ->name('password.confirm');

        Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
            ->middleware('auth');

        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
            ->middleware('auth')
            ->name('logout');

    });