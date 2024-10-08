<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Character extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'enemy',
        'defence',
        'strength',
        'accuracy',
        'magic',
        'user_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'enemy' => 'boolean'
        ];
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function contests() : BelongsToMany {
        if ($this->enemy){
            return $this->belongsToMany(Contest::class, 'character_contest', 'enemy_id', 'contest_id')->withPivot('enemy_hp', 'hero_hp');
        }
        else{
            return $this->belongsToMany(Contest::class)->withPivot('enemy_hp', 'hero_hp', 'enemy_id');
        }
    }
}
