<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Client extends Model
{
    protected $guarded = [];
    public function contacts(): BelongsToMany
    {
        return $this->belongsToMany(Contact::class)->withPivot(['description'])->using(ClientContact::class);
    }

    public function clientContacts(): HasMany
    {
        return $this->hasMany(ClientContact::class);
    }
}
