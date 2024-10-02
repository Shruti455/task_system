<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Admin;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'task_attachment',
        'assigned_user',
        'status',
        'created_by',
    ];

    public function assigned_users(){
        return $this->belongsTo(User::class, 'assigned_user');
    }

    public function created_by(){
        return $this->belongsTo(Admin::class, 'created_by');
    }
}
