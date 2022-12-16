<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    const TABLE_NAME = 'tasks';

    /**
     * @inheritdoc
     *
     * @var string
     */
    protected $table = self::TABLE_NAME;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'status',
        'expires_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'expires_at',
    ];
}
