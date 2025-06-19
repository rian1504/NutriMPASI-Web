<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Baby extends Model
{
    // Guard the id field
    protected $guarded = ['id'];

    // hidden field
    protected $hidden = ['created_at', 'updated_at'];

    // Define the relationship
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function baby_schedules(): HasMany
    {
        return $this->hasMany(BabySchedule::class);
    }

    public function food_records(): HasMany
    {
        return $this->hasMany(FoodRecord::class);
    }

    public function food_recommendations(): HasMany
    {
        return $this->hasMany(FoodRecommendation::class);
    }

    // Hitung usia bayi dalam bulan
    public function getAgeInMonths(): int
    {
        if (!$this->dob) {
            return 0;
        }

        return Carbon::parse($this->dob)->diffInMonths(now());
    }

    // Kategori usia bayi berdasarkan rentang
    public function getAgeCategory(): string
    {
        $months = $this->getAgeInMonths();

        if ($months >= 6 && $months <= 8) return '6-8';
        if ($months >= 9 && $months <= 11) return '9-11';
        if ($months >= 12 && $months <= 23) return '12-23';

        return '0-5'; // Di luar rentang yang ditentukan
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($baby) {
            // Ambil dulu semua data yang diperlukan
            $scheduleIds = $baby->baby_schedules()->pluck('schedule_id');

            // Hapus relasi manual
            $baby->baby_schedules()->delete();

            // Proses penghapusan schedule yatim
            Schedule::whereIn('id', $scheduleIds)
                ->doesntHave('baby_schedules')
                ->delete();
        });
    }
}
