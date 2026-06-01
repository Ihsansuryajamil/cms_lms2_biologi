<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskSubmission extends Model
{
    protected $table = 'tugas_submissions';

    protected $fillable = [
        'sub_topic_id',
        'student_id',
        'jawaban_teks',
        'file_jawaban',
        'link_jawaban',
        'nilai',
        'catatan_guru',
        'status',
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