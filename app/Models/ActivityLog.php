<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class ActivityLog extends Model
{
    use HasFactory, HasUuids;

    /**
     * The database table associated with the model.
     *
     * @var string
     */
    protected $table = 'activity_logs';

    /**
     * Indicates that the `id` column should be guarded from mass assignment.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Indicates that the `id` column should be treated as a string type.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Get the user associated with the activity log.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }
}
