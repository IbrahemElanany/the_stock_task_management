<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['user_id','title','description','due_date','status'];

    public function ScopeOwner($query)
    {
        $query->where('user_id', auth()->id())->orWhere(function ($query){
            $query->whereHas('collaborations', function ($collaborator) {
                $collaborator->where('user_id', auth()->id());
            });
        });
    }

    /**
     * @return HasMany
     */
    public function collaborations(): HasMany
    {
        return $this->hasMany(Collaboration::class);
    }

    /**
     * @return HasMany
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }
}
