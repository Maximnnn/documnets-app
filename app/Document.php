<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Class Document
 * @package App
 * @property $id int
 * @property $path string
 * @property $name string
 */
class Document extends Model
{
    public $table = 'documents';

    protected $fillable = ['path', 'name'];

    public function getPathAttribute()
    {
        return Storage::url($this->attributes['path']);
    }
}
