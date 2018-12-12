<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = ['name', 'slug', 'description'];
 
    public function getAll( $filters = array() ){
    	$users = $this->select('*');
    	foreach( $filters as $key => $value ){
    		$users->where( $value['field'], $value['operation'], $value['value'] );
    	}
    	return $users->paginate(10);
    }
}
