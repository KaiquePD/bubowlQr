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
 * @property int $id_user
 * @property string $name
 * @property string $url
 * @property string $desc
 * @property string $end
 * @property string $horFunc
 * @property string $tel
 * @property string $color
 * @property string $logo_path
 * @property string $status
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property User $user
 * @property Collection|Segment[] $segments
 *
 * @package App\Models
 */
class Rest extends Model
{
	use SoftDeletes;
	protected $table = 'rests';

	protected $casts = [
		'id_user' => 'int'
	];

	protected $hidden = [
		'remember_token'
	];

	protected $fillable = [
		'id_user',
		'name',
		'url',
		'desc',
		'end',
		'horFunc',
		'tel',
		'color',
		'logo_path',
		'status',
		'remember_token'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}

	public function segments()
	{
		return $this->hasMany(Segment::class, 'id_rest');
	}
}
