<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;

final class ForumController extends Controller
{
    public function __invoke()
    {
        $topics = [

            [
                'title'       => 'BeeApp Beekeeping Forum - Start Here!',
                'description' => 'Please say hello and introduce yourself in our Welcome Forum or check for the latest announcements',
                'topics'      => [
                    [
                        'title'       => 'Welcome Forum',
                        'description' => 'If this is your first time on the BeeApp Beekeeping Forums, please introduce yourself here.',
                    ],
                    [
                        'title'       => 'Rules & Announcements',
                        'description' => 'This is a "read only" forum.',
                    ],
                    [
                        'title'       => 'Welcome Forum',
                        'description' => 'This is a "read only" forum.',
                    ],
                ]
            ],
            [
                'title'       => 'Frequently Asked Questions',
                'description' => '',
                'topics'      => [
                    [
                        'title'       => 'FAQ',
                        'description' => 'A list of Frequently Asked Questions and links to the corresponding threads.',
                    ],

                ]
            ],
            [
                'title'       => 'General Beekeeping Forums',
                'description' => '',
                'topics'      => [
                    [
                        'title'       => 'How to Start Beekeeping',
                        'description' => 'A curated joint effort to develop an FAQ on all aspects of beginning beekeeping. Note that this sub-forum and its \'child sub-forums are \'closed to new posts. Please use other sub-forums to start new threads.',
                    ],
[
    'title'       => 'History of Beekeeping',
    'description' => 'A curated joint effort to develop an FAQ on all aspects of beginning beekeeping. Note that this sub-forum and its \'child sub-forums are \'closed\' to new posts. Please use other sub-forums to start new threads.',
                    ],
                ]
            ],

        ];
        return view('forum.index', compact('topics'));
    }
}
