<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name',
        'description',
        'column_id',
        'position',
        'created_by'
    ];

    public function columns()
    {
        return $this->belongsTo(Column::class, 'columns_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
        
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'tasks_id');
    }
}
