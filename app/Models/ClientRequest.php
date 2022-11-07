<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ip_address',
        'user_agent',
        'weather_info',
        'city',
        'coordinates',
        'playlist_recommended_id'
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'weather_info' => 'json',
        'coordinates' => 'json'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
