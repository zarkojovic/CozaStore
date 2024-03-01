<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model {

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'action_id',
        'log_message',
    ];

    /**
     * Methods to add logs to the database
     *
     * @var array<int, string>
     */
    public static function informationLog(string $message, int $userId = NULL) {
        $newLog = new Log();

        $newLog->log_message = $message;
        $newLog->action_id = 1;

        if ($userId) {
            $newLog->user_id = $userId;
        }

        $newLog->save();
    }

    public static function warningLog(string $message, int $userId = NULL) {
        $newLog = new Log();

        $newLog->log_message = $message;
        $newLog->action_id = 2;

        if ($userId) {
            $newLog->user_id = $userId;
        }

        $newLog->save();
    }

    public static function errorLog(string $message, int $userId = NULL) {
        $newLog = new Log();

        $newLog->log_message = $message;
        $newLog->action_id = 3;

        if ($userId) {
            $newLog->user_id = $userId;
        }

        $newLog->save();
    }

    /**
     * Log Relationships
     */
    public function action() {
        return $this->belongsTo(Action::class);
    }

}
