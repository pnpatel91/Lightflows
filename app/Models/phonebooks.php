<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phonebooks extends Model
{
    use HasFactory;

    /**
     * Get the creator of this phonebook.
     */
    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }

    /**
     * Get the last editor of this phonebook.
     */
    public function editor(){
        return $this->belongsTo(User::class,'updated_by');
    }
}
