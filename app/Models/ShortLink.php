<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{
    use HasFactory;
    protected $fillable = [
        'jira_ticket',
        'name',
        'url_links',
        'short_link',
    ];
}