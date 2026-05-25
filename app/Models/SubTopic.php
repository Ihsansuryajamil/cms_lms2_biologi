<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubTopic extends Model
{
    protected $table = 'sub_topics';

    protected $fillable = [
        'topic_id',
        'judul',
        'jenis',
        'status',
        'deskripsi',
        'link_1',
        'link_2',
        'link_3',
        'file_1',
        'file_2',
        'file_3',
        'urutan'
    ];

    // Mengetahui sub-topik ini bagian dari bab/topik mana
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }
}