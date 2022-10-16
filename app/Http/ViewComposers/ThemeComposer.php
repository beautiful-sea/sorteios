<?php

namespace App\Http\ViewComposers;

use App\Models\Theme;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ThemeComposer
{
    protected $user;
    protected $theme;

    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = Auth::user();
    }


}
