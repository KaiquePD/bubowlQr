<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Segment
 * 
 * @property int $id
 * @property int $id_rest
 * @property string $name
 * @property string $desc
 * @property string $status
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Rest $rest
 * @property Collection|Food[] $food
 *
 * @package App\Models
 */
class Segment extends Model
{
	use SoftDeletes;
	protected $table = 'segments';

	protected $casts = [
		'id_rest' => 'int'
	];

	protected $hidden = [
		'remember_token'
	];

	protected $fillable = [
		'id_rest',
		'name',
		'desc',
		'status',
		'remember_token'
	];

	public function rest()
	{
		return $this->belongsTo(Rest::class, 'id_rest');
	}

	public function food()
	{
		return $this->hasMany(Food::class, 'id_segment');
	}
}
