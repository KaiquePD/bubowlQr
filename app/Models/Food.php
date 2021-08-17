<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Food
 * 
 * @property int $id
 * @property int $id_segment
 * @property string $name
 * @property string $desc
 * @property float $price
 * @property string $status
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Segment $segment
 *
 * @package App\Models
 */
class Food extends Model
{
	use SoftDeletes;
	protected $table = 'foods';

	protected $casts = [
		'id_segment' => 'int',
		'price' => 'float'
	];

	protected $hidden = [
		'remember_token'
	];

	protected $fillable = [
		'id_segment',
		'name',
		'desc',
		'price',
		'status',
		'remember_token'
	];

	public function segment()
	{
		return $this->belongsTo(Segment::class, 'id_segment');
	}
}
