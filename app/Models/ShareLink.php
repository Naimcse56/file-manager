<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShareLink extends Model
{
   protected $fillable = [
                            'file_id',
                            'user_id',
                            'token',
                            'expires_at',
                            'can_download'
                        ];

}
