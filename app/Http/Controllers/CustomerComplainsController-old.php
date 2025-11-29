<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerComplain;
use App\Models\CustomerComplainLog;
use App\Models\CustomerComplainType;
use App\Models\ComplainCategory;
use App\Models\ComplainSubcategory;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Region;
use App\Models\Location;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use App\Mail\ContactMail;
use App\Mail\CustomerMail;
use App\Mail\ApplicantMail;
use Illuminate\Support\Facades\Mail;

class CustomerComplainsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisions = Location::whereNull('parent_id')->pluck('name', 'id');
        
        $user_id = auth()->user()->id;
        $employees = User::where('id',auth()->user()->id)
        ->get();
        $employees = $employees[0];
        //dd($user_id);
            if($employees->id == 341 ){
                $CustomerComplains = CustomerComplain::with([
                    'region'=>function($q){
                        return $q->select('id', 'name');
                    },
                    'customercomplaintype'=>function($q){
                        return $q->select('id', 'name');
                    },
                    'department'=>function($q){
                        return $q->select('id', 'name');
                    },
                    'district'=>function($q){
                        return $q->select('*');
                    },
                    'user'=>function($q){
                        return $q->select('*');
                    },
                ])
                ->where('complain_status','Pending')
                ->orWhere('complain_status','Marketing')
                //Carbon::parse($employees['birthdate'])->format('d-m-Y');
                ->get(); 
            }elseif ($employees->id == 334) {
                $CustomerComplains = CustomerComplain::with([
                'region'=>function($q){
                    return $q->select('id', 'name');
                },
                'customercomplaintype'=>function($q){
                    return $q->select('id', 'name');
                },
                'department'=>function($q){
                    return $q->select('id', 'name');
                },
                'district'=>function($q){
                    return $q->select('*');
                },
                'user'=>function($q){
                    return $q->select('*');
                },
                ])
                ->where('complain_status','QC')
                ->orWhere('complain_status','NotSatisfactory')
                //Carbon::parse($employees['birthdate'])->format('d-m-Y');
                ->get(); 
            }elseif($user_id){
                $CustomerComplains = CustomerComplain::with([
                'region'=>function($q){
                    return $q->select('id', 'name');
                },
                'customercomplaintype'=>function($q){
                    return $q->select('id', 'name');
                },
                'department'=>function($q){
                    return $q->select('id', 'name');
                },
                'district'=>function($q){
                    return $q->select('*');
                },
                'user'=>function($q){
                    return $q->select('*');
                },
            ])
            ->where('complain_status','Processing')
            ->where('status','Processing')
            ->where('user_id',$user_id)
            //Carbon::parse($employees['birthdate'])->format('d-m-Y');
            ->get();
            }
        
        
        //$CustomerComplains = CustomerComplain::get();
        //dd($CustomerComplains->toArray());
        return view('customerComplains.index', compact('CustomerComplains','employees'));
        //return view('customerComplains.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $comlainTypes = CustomerComplainType::pluck('name','id');
        $comlainCategories = ComplainCategory::pluck('name','id');
        $comlainSubCategories = ComplainSubcategory::pluck('name','id');
        //dd($comlainCategories);
        $employees = User::where('id',auth()->user()->id)
        ->get();
        //$comlainTypes[0] = $comlainTypes[0];
        //dd($comlainTypes->toArray());
        $divisions = Location::whereNull('parent_id')->pluck('name', 'id');
        $products = Product::pluck('name', 'id');
        return view('customerComplains.create', compact('comlainTypes','employees', 'divisions', 'products', 'comlainCategories','comlainSubCategories'));
        //return view('customerComplains.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_method', '_token');
        //dd($data);
        $request->validate([
            'complainant_name' => 'required',
            'complainant_mobile' => 'required',
            'complainant_email' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'required',
            'complainant_address' => 'required',
            'sending_ways' => 'required',
            'receiving_person_name' => 'required',
            'receiving_person_mobile' => 'required',
            'customercomplaintype_id' => 'required',
            'description' => 'required',
            'batch_no' => 'required',
            'product_id' => 'required',
            'production_date' => 'required',
        ]);
        $employees = User::where('id',auth()->user()->id)
        ->get();
        $employees = $employees[0];
        //dd($employees->toArray());
        if($request->file('file')){
            $file = $request->file('file');
            $extension =$file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('storage/complainImages/', $filename);
            $data['file'] = $filename;
        }
        //dd($filename);
        $data['employee_id'] = $employees['id'];
        $data['department_id'] = $employees['department_id'];
        $data['region_id'] = $employees['region_id'];
        $data['complainant_name'] = $request['complainant_name'];
        $data['complainant_mobile'] = $request['complainant_mobile'];
        $data['complainant_email'] = $request['complainant_email'];
        $data['division_id'] = $request['division_id'];
        $data['district_id'] = $request['district_id'];
        $data['thana_id'] = $request['thana_id'];
        $data['area'] = $request['area'];
        $data['complainant_address'] = $request['complainant_address'];
        $data['sending_ways'] = $request['sending_ways'];
        $data['receiving_person_name'] = $request['receiving_person_name'];
        $data['receiving_person_mobile'] = $request['receiving_person_mobile'];
        $data['batch_no'] = $request['batch_no'];
        $data['production_date'] = $request['production_date'];
        $data['customercomplaintype_id'] = $request['customercomplaintype_id'];
        $data['complain_catId'] = $request['complain_catId'];
        $data['complain_subcatId'] = $request['complain_subcatId'];
        $data['primary_source'] = $request['primary_source'];
        $data['othersComplain'] = $request['othersComplain'];
        $data['description'] = $request['description'];
        $data['user_id'] = auth()->user()->id;
        //$data['file'] = $filename;
        $data['complain_status'] = 'Pending';
        $data['status'] ='Pending';
        $data['complain_date'] =Carbon::now();
        //dd($data);
        $CustomerComplain = CustomerComplain::create($data);
        $lastInsertedID   = $CustomerComplain->id;
        $data['id'] =$lastInsertedID;
        //dd($data);
        if ($CustomerComplain) {
            $customerMail    = $data['complainant_email'];
            $admin_email     = ['almach.hasan@polarbd.com'];
            //$admin_email     = ['zashidul@polarbd.com','care@polarbd.com'];

            $customer_email  = $data['complainant_email'];
            Mail::to($customerMail)->send(new CustomerMail($data));
            Mail::to($admin_email)->send(new ContactMail($data));
            
            $message = "You have successfully Submitted the Application........";
            return redirect()->route('customerComplains.create', [])
                ->with('flash_success', $message);

        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('customerComplains.create', [])
                ->with('flash_danger', $message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        //dd('komol');
        $viewer = CustomerComplain::selectRaw('MONTH(complain_date) as month, count(*) as count') 
            ->whereYear('complain_date',Carbon::today())
            ->groupBy('month')
            ->orderBy('month')
            ->get()->toArray();  
        $viewer = array_column($viewer, 'count'); 
        //dd($viewer); 

        $click = CustomerComplain::selectRaw('MONTH(complain_date) as month, count(*) as count') 
            ->whereYear('complain_date',Carbon::today())
            ->where('status', '=', 'Pending')
            ->groupBy('month')
            ->orderBy('month')
            ->get()->toArray();  
        $click = array_column($click, 'count'); 
          
                      
        return view('customerComplains.dashboard')  
                ->with('viewer',json_encode($viewer,JSON_NUMERIC_CHECK))  
                ->with('click',json_encode($click,JSON_NUMERIC_CHECK)); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function viewCustomerComplain($id)
    {
        $divisions = Location::whereNull('parent_id')->pluck('name', 'id');
        //dd($id);
        $CustomerComplains = CustomerComplain::with([
            'department'=>function($q){
                return $q->select('id', 'name');
            },
            'region'=>function($q){
                return $q->select('id', 'name');
            },
            'customercomplaintype'=>function($q){
                return $q->select('id', 'name');
            },
            'customercomplainlog'=>function($q){
                return $q->select('*');
            },
            'division'=>function($q){
                return $q->select('*');
            },
            'district'=>function($q){
                return $q->select('*');
            },
            'thana'=>function($q){
                return $q->select('*');
            },
            'customercomplainlog'=>function($q){
                return $q->select('*');
            },
            'user'=>function($q){
                return $q->select('*');
            },
            'product'=>function($q){
                return $q->select('*');
            },
            

        ])
        ->where('id',$id)
        ->get();
        
        $CustomerComplains[0] = $CustomerComplains[0];
        //dd($CustomerComplains->toArray());
        $user_id = User::where('id',auth()->user()->id)
        ->get();
        $user_id[0] = $user_id[0];
        $CustomerComplainLogs = CustomerComplainLog::with([
            'department'=>function($q){
                return $q->select('id', 'name');
            },
            'user'=>function($q){
                return $q->select('*');
            },
            
        ])
        ->where('customercomplain_id',$id)
        ->get();
       
        return view('customerComplains.viewComplain', compact('CustomerComplains', 'user_id', 'CustomerComplainLogs', 'divisions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_method', '_token', 'title');
        //dd($data);
        $request->validate([
            'comments' => 'required',
        ]);
        $Application_emp_id = CustomerComplain::select('user_id', 'complain_status')
                    ->where('id', $id)
                    ->get();
        $Application_emp_id = $Application_emp_id[0];
        $Apply_emp_id       = $Application_emp_id['user_id'];
        $complain_status    = $Application_emp_id['complain_status'];
        //dd($complain_status);
        $Users = User::where('id',auth()->user()->id)
        ->get();
        $Users = $Users[0];
        $department_id = $Users['department_id'];
        
        

        $test['customercomplain_id'] = $data['id'];
        $test['user_id'] = auth()->user()->id;
        $test['department_id'] = $department_id;
        $test['result_complainant'] = $data['result_complainant'];
        $test['corrective_action'] = $data['corrective_action'];
        $test['issatisfactory'] = $data['issatisfactory'];
        $test['response_complainant'] = $data['response'];
        $test['comments'] = $data['comments'];
        $test['created_at'] = Carbon::now();
        $test['updated_at'] = Carbon::now();
                       
        //dd($test);
        //if($data['issatisfactory'] == 'satisfactory' && $Apply_emp_id == 333){
        //  dd($data); 
        //}
        $customercomplain = CustomerComplainLog::insert($test);
        if ($customercomplain) {
            if ($department_id == 12 && $data['issatisfactory'] == 'not_satisfactory' && $complain_status == 'Pending') {
                $ComUpdate['complain_status'] = 'QC';
                $ComUpdate['status'] = 'Processing';

                $admin_email     = ['samir.paul@polarbd.com', 'zashidul@polarbd.com'];
                Mail::to($admin_email)->send(new ContactMail($data));

            }elseif ($department_id == 14 && $complain_status == 'QC'  && $data['issatisfactory'] == 'not_satisfactory') {
                $ComUpdate['complain_status'] = 'Marketing';
                $ComUpdate['status'] = 'Processing';

                $admin_email     = ['mamun@polarbd.com', 'zashidul@polarbd.com'];
                Mail::to($admin_email)->send(new ContactMail($data));

            }elseif ($department_id == 12 && $complain_status == 'Marketing' && $data['issatisfactory'] == 'not_satisfactory'){
                $ComUpdate['complain_status'] = 'NotSatisfactory';
                $ComUpdate['status'] = 'Processing';

                $admin_email     = ['samir.paul@polarbd.com', 'zashidul@polarbd.com'];
                Mail::to($admin_email)->send(new ContactMail($data));

            }elseif ($department_id == 14 && $complain_status == 'NotSatisfactory' && $data['issatisfactory'] == 'not_satisfactory'){
                $ComUpdate['complain_status'] = 'Marketing';
                $ComUpdate['status'] = 'Processing';
            }elseif ($department_id == 12 && $data['issatisfactory'] == 'satisfactory' && $complain_status == 'Marketing') {
                $ComUpdate['complain_status'] = 'Completed';
                $ComUpdate['status'] = 'Completed';
                //Send Notification Mail Start
                $Application_emp_email = User::select('email')
                ->where('id', $Apply_emp_id)
                ->get();
                $Application_emp_email = $Application_emp_email[0];
                $ApplicantMail      = $Application_emp_email['email'];

                $Corrective_Action  = CustomerComplainLog::select('corrective_action')
                ->where('customercomplain_id', $id)
                ->where('user_id', 334)
                ->get();
                $Corrective_Action  = $Corrective_Action[0];
                $TakeAction         = $Corrective_Action['corrective_action'];
                //dd($TakeAction);
                $test['corrective_action'] = $TakeAction ;
                
                Mail::to($ApplicantMail)->send(new ApplicantMail($test)); 
            }
        
            
            CustomerComplain::where('id',$id)->update($ComUpdate);

            $message = "You have successfully updated";
            return redirect()->route('customerComplains.index', [])
                ->with('flash_success', $message);

        } else {
            $message = "Something went wrong! Please try again....";
            return redirect()->route('customerComplains.index', [])
                ->with('flash_danger', $message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function processing()
    {
        $divisions = Location::whereNull('parent_id')->pluck('name', 'id');
        $CustomerComplains = CustomerComplain::with([
                'region'=>function($q){
                    return $q->select('id', 'name');
                },
                'customercomplaintype'=>function($q){
                    return $q->select('id', 'name');
                },
                'department'=>function($q){
                    return $q->select('id', 'name');
                },
                'division'=>function($q){
                return $q->select('*');
                },
                'district'=>function($q){
                    return $q->select('*');
                },
                'thana'=>function($q){
                    return $q->select('*');
                },
                'customercomplainlog'=>function($q){
                    return $q->select('*');
                },
                'user'=>function($q){
                    return $q->select('*');
                },
                'product'=>function($q){
                return $q->select('*');
            },
            ])
            ->where('status','Processing')
            ->get();
        

        return view('customerComplains.processing', compact('CustomerComplains', 'divisions'));
    }

    public function viewProcessing($id)
    {
        //dd($id);
        $CustomerComplains = CustomerComplain::with([
            'department'=>function($q){
                return $q->select('id', 'name');
            },
            'region'=>function($q){
                return $q->select('id', 'name');
            },
            'customercomplaintype'=>function($q){
                return $q->select('id', 'name');
            },
            'customercomplainlog'=>function($q){
                return $q->select('*');
            },
            'user'=>function($q){
                return $q->select('*');
            },
            'product'=>function($q){
                return $q->select('*');
            },
            

        ])
        ->where('id',$id)
        ->get();
        
        $CustomerComplains[0] = $CustomerComplains[0];

        $CustomerComplainLogs = CustomerComplainLog::with([
            'department'=>function($q){
                return $q->select('id', 'name');
            },
            'user'=>function($q){
                    return $q->select('*');
            },

        ])
        ->where('customercomplain_id',$id)
        ->get();
        
        $CustomerComplainLogs[0] = $CustomerComplainLogs[0];

        return view('customerComplains.viewProcessing', compact('CustomerComplains', 'CustomerComplainLogs'));
    }

    public function completed()
    {
        $CustomerComplains = CustomerComplain::with([
                'region'=>function($q){
                    return $q->select('id', 'name');
                },
                'customercomplaintype'=>function($q){
                    return $q->select('id', 'name');
                },
                'department'=>function($q){
                    return $q->select('id', 'name');
                },
                'user'=>function($q){
                    return $q->select('*');
                },
                'product'=>function($q){
                return $q->select('*');
            },
            ])
            ->where('status','Completed')
            ->get();
        

        return view('customerComplains.completed', compact('CustomerComplains'));
       
    }

    public function viewCompleted($id)
    {
        //dd($id);
        $CustomerComplains = CustomerComplain::with([
            'department'=>function($q){
                return $q->select('id', 'name');
            },
            'region'=>function($q){
                return $q->select('id', 'name');
            },
            'customercomplaintype'=>function($q){
                return $q->select('id', 'name');
            },
            'customercomplainlog'=>function($q){
                return $q->select('*');
            },
            'user'=>function($q){
                return $q->select('*');
            },
            'product'=>function($q){
                return $q->select('*');
            },
            

        ])
        ->where('id',$id)
        ->get();
        
        $CustomerComplains[0] = $CustomerComplains[0];

        $user_dept_id = User::where('id',auth()->user()->id)
        ->get();
        $user_dept_id[0] = $user_dept_id[0];

        $CustomerComplainLogs = CustomerComplainLog::with([
            'department'=>function($q){
                return $q->select('id', 'name');
            },
            'user'=>function($q){
                return $q->select('*');
            },

        ])
        ->where('customercomplain_id',$id)
        ->get();
        
        $CustomerComplainLogs[0] = $CustomerComplainLogs[0];

        return view('customerComplains.viewCompleted', compact('CustomerComplains', 'user_dept_id', 'CustomerComplainLogs'));
    }

    public function customerComplainDownload($id)
    {
        $CustomerComplains = CustomerComplain::with([
            'department'=>function($q){
                return $q->select('id', 'name');
            },
            'region'=>function($q){
                return $q->select('id', 'name');
            },
            'customercomplaintype'=>function($q){
                return $q->select('id', 'name');
            },
            'customercomplainlog'=>function($q){
                return $q->select('*');
            },
            'division'=>function($q){
                return $q->select('*');
            },
            'district'=>function($q){
                return $q->select('*');
            },
            'thana'=>function($q){
                return $q->select('*');
            },
            'user'=>function($q){
                return $q->select('*');
            },
            'product'=>function($q){
                return $q->select('*');
            },
            
            

        ])
        ->where('id',$id)
        ->get();
        //dd($CustomerComplains);
        $CustomerComplains[0] = $CustomerComplains[0];
        $CustomerComplainLogs = CustomerComplainLog::with([
            'department'=>function($q){
                return $q->select('id', 'name');
            },
           'user'=>function($q){
                return $q->select('*');
            },

        ])
        ->where('customercomplain_id',$id)
        ->get();
        
        //$CustomerComplainLogs[0] = $CustomerComplainLogs[0];

        $pdf = \domPDF::loadView('pdf.customerComplain_download', compact('CustomerComplains', 'CustomerComplainLogs'));
        return $pdf->setPaper('a4', 'Portrait')->download('customerComplain.pdf');  

        //$pdf = \domPDF::loadView('pdf.approveRequisitionDownload', compact('RequisitionDetails', 'particulars', 'id', 'subcategories', 'stocks', 'RequisitionLogs', 'requisitionDate', 'reqQuantities', 'consumptions'));
        //return $pdf->setPaper('a4', 'landscape')->download('approveRequisition.pdf');  
            //return $pdf->download($id . '.pdf');
    }
}
