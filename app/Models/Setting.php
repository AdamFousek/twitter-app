<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * Fillable columns
     * @var string[]
     */
    public $fillable = ['value'];

    /**
     * Disable timestamps during saving/inserting
     * @var bool
     */
    public $timestamps = false;
}
