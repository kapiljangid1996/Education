<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteVisitor extends Model
{
    use HasFactory;

    protected $table = 'website_visitors';

    protected $fillable = ['ip_address'];

}