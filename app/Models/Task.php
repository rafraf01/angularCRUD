<?php
/**
 * Created by PhpStorm.
 * User: rafael.delacruz
 * Date: 2/14/18
 * Time: 10:17 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Task extends Model{

    /**
     * Table name
     * @var string
     */
    protected $table = 'task';


    protected $primary_key = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'task_name', 'description', 'id', 'created_by'
    ];

    /**
     * Relationship to User
     * @return mixed
     */
    public function user(){
        return $this->belongsTo('App\User','created_by','id');
    }



}