<?php

namespace App\Models;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Region;
use App\Models\User;
use App\Models\Product;
use App\Models\CustomerComplainLog;
use App\Models\CustomerComplainType;

use Illuminate\Database\Eloquent\Model;

class CustomerComplain extends Model
{
   //public $timestamps = false;
	protected $guarded = array('id');

	protected $fillable = ['complainant_name', 'complainant_email', 'complainant_mobile', 'division_id', 'district_id', 'thana_id', 'area', 'complainant_address', 'sending_ways',  'department_id',  'complain_date',  'product_id', 'region_id',  'receiving_person_name', 'receiving_person_mobile', 'description', 'batch_no', 'production_date', 'file', 'customercomplaintype_id', 'complain_catId', 'complain_subcatId', 'primary_source',  'othersComplain', 'complain_status', 'status', 'user_id'];

	public function user() {
		return $this->belongsTo(User::class);
	}

	public function product() {
		return $this->belongsTo(Product::class);
	}

	public function region() {
		return $this->belongsTo(Region::class);
	}

	public function division() {
        return $this->belongsTo(Location::class);
    }

    public function district() {
        return $this->belongsTo(Location::class);
    }

    public function thana() {
        return $this->belongsTo(Location::class);
    }

	public function department() {
		return $this->belongsTo(Department::class);
	}

	public function customercomplaintype() {
		return $this->belongsTo(CustomerComplainType::class);
	}

	public function customercomplainlog() {
		return $this->hasMany(CustomerComplainLog::class, 'customercomplain_id');
	}

	public function build()
	{
		$name = $this->data['name'];
		$subjectData = $this->data['subject'];
		$subject = 'Thank You';
		return $this->markdown('customerComplains.create')
		->subject($subject)
		->with([
			'data'->$this->data
		]);
	}

}
