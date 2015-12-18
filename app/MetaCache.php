<?php namespace Gomention;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MetaCache
 * @package App
 */
class MetaCache extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'meta_cache';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array'
    ];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function by_user (){

        return $this->belongsTo('Gomention\User', 'user_id', 'id');

    }

}
