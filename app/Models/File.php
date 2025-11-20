<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'folder_id', 'user_id', 'name',
        'type', 'size', 'path', 'is_private'
    ];

    public function folder() {
        return $this->belongsTo(Folder::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function versions() {
        return $this->hasMany(FileVersion::class);
    }

    public function shares() {
        return $this->hasMany(ShareLink::class);
    }
}
