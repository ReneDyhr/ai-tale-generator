<?php

use App\Livewire\Homepage;
use App\Livewire\Story;
use Illuminate\Support\Facades\Route;

Route::get('/', Homepage::class)->name('homepage');

Route::get('/story/{uuid}', Story::class)->name('story');
