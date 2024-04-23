<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Contest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'win',
        'history',
    ];

    protected $casts = [
        'history' => 'array', // Cast 'history' attribute to array when retrieving from DB
    ];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function place() : BelongsTo {
        return $this->belongsTo(Place::class);
    }

    public function characters() : BelongsToMany {
        return $this->belongsToMany(Character::class)->withPivot('enemy_hp', 'hero_hp');
    }
}
