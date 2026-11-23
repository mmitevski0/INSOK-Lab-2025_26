<?php

namespace App\Models;

use App\Observers\CourseObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy(CourseObserver::class)]
class Course extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }
}
