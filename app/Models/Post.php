<?php

namespace App\Models;

use App\Events\PostCreatedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        "creted"=> PostCreatedEvent::class,
    ];
}
