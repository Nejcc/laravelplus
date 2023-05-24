<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;

final class ThreadController extends Controller
{
    public function __invoke()
    {
        $topics = [
            [
                'title' => 'Welcome Forum',
                'description' => 'If this is your first time on the Beesource Beekeeping Forums, please introduce yourself here.',
            ],
            [
                'title' => 'Welcome Forum',
                'description' => 'If this is your first time on the Beesource Beekeeping Forums, please introduce yourself here.',
            ],
            [
                'title' => 'Welcome Forum',
                'description' => 'If this is your first time on the Beesource Beekeeping Forums, please introduce yourself here.',
            ],
        ];
        return view('forum.index', compact('topics'));
    }
}
