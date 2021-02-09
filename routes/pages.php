<?php
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\PagesController;
route::get('/payment', [PagesController::class, 'pagamento']);