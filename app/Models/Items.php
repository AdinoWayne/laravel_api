<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $table = 'items';

    protected $fillable = [
        'id', 'owner_id', 'name', 'title', 'job_point', 'job_text', 'job_category', 'job_type', 'job_type', 'salary', 'salary_remarks', 'add_display', 'reason', 'qualifications', 'welfare', 'note', 'images', 'is_active', 'is_delete'
    ];

    public function owner () {
        return $this->belongsTo('App\Models\Owner');
    }
}
