<?php

namespace App\Http\Controllers;

class FileController extends Controller
{
    public function show()
    {
        return response()->file('doc/block_games_role.docx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ]);
    }
}
