<?php
/**
 * User: kazak
 * Email: mk@altrecipe.com
 * Date: 2019-04-19
 * Time: 17:26
 */

namespace ArHelpers\Models\Base;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

/**
 * Class BaseModel
 *
 * @package App\Models
 * @property $id
 * @method updateOrCreate(array $uniq_value, array $new_values)
 * @method static create(array $fields)
 * @method static Builder|BaseModel newModelQuery()
 * @method static Builder|BaseModel newQuery()
 * @method static Builder|BaseModel query()
 * @mixin Eloquent
 */
class BaseModel extends Model {
	public function have($attr) {
		return Schema::hasColumn($this->getTable(), $attr);
	}

	public $rules;

    protected static function callMethod($method, $params) {
        $class = get_called_class();
        if (method_exists($class, $method)) {
            $class::$method($params);
        }
    }

    public static function boot() {
        parent::boot();

        self::creating(function($model) {
            self::callMethod('beforeCreate', $model);
        });

        self::created(function($model) {
            self::callMethod('afterCreate', $model);
        });

        self::updating(function($model) {
            self::callMethod('beforeUpdate', $model);
        });

        self::updated(function($model) {
            self::callMethod('afterUpdate', $model);
        });

        self::deleting(function($model) {
            self::callMethod('beforeDelete', $model);
        });

        self::deleted(function($model) {
            self::callMethod('afterDelete', $model);
        });
    }
}
