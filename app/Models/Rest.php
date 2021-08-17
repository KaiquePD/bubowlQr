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
 * Class Rest
 * 
 * @property int $id
 * @property string $name
 * @property string $desc
 * @property string $end
 * @property string $tel
 * @property string $color
 * @property string $logo_path
 * @property string $status
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Collection|Segment[] $segments
 *
 * @package App\Models
 */
class Rest extends Model
{
	use SoftDeletes;
	protected $table = 'rests';

	protected $hidden = [
		'remember_token'
	];

	protected $fillable = [
		'name',
		'desc',
		'end',
		'tel',
		'color',
		'logo_path',
		'status',
		'remember_token'
	];

	public function segments()
	{
		return $this->hasMany(Segment::class, 'id_rest');
	}
}
