<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attachment extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['task_id','attachment'];

    /**
     * @return String
     */
    public function getAttachmentAttribute($attachment): String
    {
        return asset($attachment);
    }

    public function setAttachmentAttribute($attachment)
    {
        if (is_file($attachment)) {
            $imagePath = upload($attachment);
            $this->attributes['attachment'] = $imagePath;
        }
    }

    /**
     * @return BelongsTo
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
