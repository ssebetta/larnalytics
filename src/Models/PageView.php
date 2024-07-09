<?php
// src/Models/PageView.php
namespace Ssebetta\Larnalytics\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'page_url',
        'viewed_at',
        'ip_address',
        'location',
        'user_agent',
        'device'
    ];
}
