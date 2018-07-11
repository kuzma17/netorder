<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cites';

    protected $fillable = ['region_id', 'name'];

    public $rules = [
        'name' => 'required',
    ];

    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function list_regions(){
        return Region::orderBy('name')->get();
    }
}
