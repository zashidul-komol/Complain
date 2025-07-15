<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerComplainLog extends Model
{
    protected $guarded = array('id');

    protected $fillable = ['customercomplain_id', 'user_id', 'department_id', 'issatisfactory', 'result_complainant', 'corrective_action', 'response_complainant', 'comments'];

	public function customer_complain() {
		return $this->belongsTo(CustomerComplain::class);
	}

	public function department() {
        return $this->belongsTo(Department::class);
    }
    public function user() {
		return $this->belongsTo(User::class);
	}

}
