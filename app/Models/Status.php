<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    protected $fillable = [
        'name',
    ];
    public $timestamps = false;
    protected $table = 'status';

    public function todos(): HasMany
    {
        return $this->hasMany(Todo::class);
    }

}
