<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Provider;
use App\Models\Template;

class Project extends Model
{
    use HasFactory;

    // should have been drivers sorry
    public function providers()
    {
        return $this->hasMany(Provider::class);
    }

    public function templates()
    {
        return $this->hasMany(Template::class);
    }
}
