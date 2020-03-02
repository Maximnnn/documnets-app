<?php

namespace App\Http\Controllers\Api;

use App\Document;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFileRequest;

class FileController extends Controller
{
    public function store(StoreFileRequest $request)
    {
        $file = $request->file('document');

        return Document::query()->create([
            'path' => $file->store('public/documents'),
            'name' => $file->getClientOriginalName()
        ]);
    }

    public function getList()
    {
        return Document::query()->paginate(20);
    }

}
