<?php

use App\Http\Controllers\API\V1\Admin\AdultController;
use App\Http\Controllers\API\V1\Admin\ClientController;
use App\Http\Controllers\API\V1\Admin\PackageTour\BenefitController;
use App\Http\Controllers\API\V1\Admin\PackageTour\DestinationPackageController;
use App\Http\Controllers\API\V1\Admin\PackageTour\HotelTourController;
use App\Http\Controllers\API\V1\Admin\PackageTour\JourneyTourController;
use App\Http\Controllers\API\V1\Admin\PackageTour\ObtainedJourneyController;
use App\Http\Controllers\API\V1\Admin\PackageTour\PaxHotelController;
use App\Http\Controllers\API\V1\Admin\PackageTour\TourPackageController;
use App\Http\Controllers\API\V1\Admin\PackageTour\TypeTourController;
use App\Http\Controllers\API\V1\Admin\PartnerController;
use App\Http\Controllers\API\V1\Admin\Passport\PassportController;
use App\Http\Controllers\API\V1\Admin\Passport\PassportNoteController;
use App\Http\Controllers\API\V1\Admin\Passport\PassportRegulationController;
use App\Http\Controllers\API\V1\Admin\Passport\PassportTypeController;
use App\Http\Controllers\API\V1\Admin\Travel\InfoTravelController;
use App\Http\Controllers\API\V1\Admin\Travel\TravelDestinationController;
use App\Http\Controllers\API\V1\Admin\Travel\TravelPackageController;
use App\Http\Controllers\API\V1\Admin\Travel\TypeTicketController;
use App\Http\Controllers\API\V1\Admin\Visa\VisaController;
use App\Http\Controllers\API\V1\Admin\Visa\VisaRegulationController;
use App\Http\Controllers\API\V1\Admin\Visa\VisaTypeController;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\CountryController;
use App\Http\Controllers\API\V1\Guest\DocumentController;
use App\Http\Controllers\API\V1\Guest\PassportController as GuestPassportController;
use App\Http\Controllers\API\V1\Guest\TourPackageController as GuestTourPackageController;
use App\Http\Controllers\API\V1\Guest\TravelController;
use App\Http\Controllers\API\V1\Guest\VisaController as GuestVisaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(["prefix" => "v1"], function(){

    // admin route
    Route::group(["prefix" => "admin", "auth:sanctum"], function(){
        Route::post("login", [AuthController::class, "login"]);
        Route::post("logout", [AuthController::class, "logout"]);

    });
    // route admin
    Route::group(["prefix" => "tour"], function(){
        Route::resource("partner", PartnerController::class);
        Route::resource("tour-packages", TourPackageController::class);
        Route::resource("destination", DestinationPackageController::class);
        Route::resource("type-tour", TypeTourController::class);
        Route::resource("journies", JourneyTourController::class);
        Route::resource("benefit-tour", BenefitController::class);
        Route::resource("obtained-tour", ObtainedJourneyController::class);
        Route::resource("hotel-tour", HotelTourController::class);
        Route::resource("pax-hotel", PaxHotelController::class);
    });

    Route::group(["prefix" => "travel"], function(){
        Route::resource("destinations", TravelDestinationController::class);
        Route::resource("packages", TravelPackageController::class);
        Route::resource("package-prices", TypeTicketController::class);
        Route::resource("info-travel", InfoTravelController::class);
    });

    Route::group(["prefix" => "document"], function(){
        Route::resource("passports", PassportController::class);
        Route::resource("passport-types", PassportTypeController::class);
        Route::resource("passport-notes", PassportNoteController::class);
        Route::resource("passport-regulations", PassportRegulationController::class);
        Route::resource("visas", VisaController::class);
        Route::resource("visa-regulations", VisaRegulationController::class);
        Route::resource("visa-types", VisaTypeController::class);
    });


    // Route guest
    Route::resource("adults", AdultController::class);
    Route::resource('tour', GuestTourPackageController::class);
    Route::get('tour-packages/{id}', [TourPackageController::class, "show"]);
    Route::resource("travels", TravelController::class);
    Route::resource("country", CountryController::class);
    Route::resource("partner", PartnerController::class);
    Route::resource("client", ClientController::class);
    Route::resource("visa", GuestVisaController::class);
    Route::resource("passport", GuestPassportController::class);
    Route::resource("document", DocumentController::class);
});
