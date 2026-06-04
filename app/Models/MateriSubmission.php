<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MateriSubmission extends Model
{
    protected $table = 'materi_submissions';

    protected $fillable = [
        'sub_topic_id',
        'student_id',
        'catatan_siswa',
        'status'
    ];

    public function subTopic(): BelongsTo
    {
        return $this->belongsTo(SubTopic::class, 'sub_topic_id');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}