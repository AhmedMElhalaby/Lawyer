<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
/**
 * @property mixed id
 * @property mixed user_id
 * @property mixed title
 * @property mixed message
 * @property mixed title_ar
 * @property mixed message_ar
 * @property mixed ref_id
 * @property mixed type
 * @property mixed read_at
 * @method Notification find(int $id)
 */
class Notification extends Model
{

    protected $table = 'notifications';

    protected $fillable = [ 'user_id','title','message','title_ar','message_ar','ref_id','type','read_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    const TYPE = [
        'General'=>0,
    ];

}
