@extends('layouts.admin')

<style type="text/css">
  input:valid {
    background-color: #99ff99;
}
select:valid {
    background-color: #99ff99;
}
textarea:valid {
    background-color: #99ff99;
}
input:valid {
    font-size: 15px;
}
</style>
@section('title', 'View Complain')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Complain</a></li>
            <li><a>View Complain</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="panel">
        <div class="col-sm-9">
            <h3 align="center"><b>DHAKA ICE CREAM INDUSTRIES LIMITED</b></h3>
        </div>
        <div class="col-sm-9">
            <h4 align="center"><b>CUSTOMER COMPLAINT RECORD FORM</b></h4>
        </div>
        <span class="pull-right">
            {!! Html::decode(link_to_route('customerComplains.processing','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
    </div>
</div>
<div class="row animated fadeInRight">
    {{ Form::model($CustomerComplains[0],array('route' => array('customerComplains.update',$CustomerComplains[0]->id),'method' => 'PUT','enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
    <div class="col-sm-10">
            <div class="panel">
                <div class="panel-content">
                
                    <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-4 ">Complain/Ticket Number</label>
                        <div class="col-sm-7">
                            {{Form::text('id',null,array('class' => 'form-control', 'readonly' => 'true'))}}
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-4 ">Date of receiving of the complaint</label>
                        <div class="col-sm-7">
                            {{Form::text('complain_date',null,array('class' => 'form-control', 'readonly' => 'true'))}}
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-4 ">Name of the Complainant</label>
                        <div class="col-sm-7">
                            {{Form::text('complainant_name',null,array('class' => 'form-control', 'readonly' => 'true'))}}
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-4 ">Complainant Personnel Mobile</label>
                        <div class="col-sm-7">
                            {{Form::text('complainant_mobile',null,array('class' => 'form-control', 'readonly' => 'true'))}}
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-4 ">Complainant Personnel Email</label>
                        <div class="col-sm-7">
                            {{Form::text('complainant_email',null,array('class' => 'form-control', 'readonly' => 'true'))}}
                        </div>
                    </div>
                    @php
                        $div    = $CustomerComplains[0]->division->name;
                        $dist   = $CustomerComplains[0]->district->name; 
                        $thana  = $CustomerComplains[0]->thana->name;
                        $addres = $CustomerComplains[0]->complainant_address;
                        $newAddress    = 'Division : '. $div . ' '. ','.' '. 'District :'.' '. $dist . ','. 'Thana :'.' '.$thana. ' '. ','. 'Address : '.  $addres; 
                    @endphp
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-4 ">Complainant Personnel Address</label>
                        <div class="col-sm-7">
                            {{Form::textarea('division_id',$newAddress,array('class' => 'form-control', 'readonly' => 'true','rows' => 2, 'cols' => 2))}}
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-4 ">Ways of Sending the Complaint</label>
                        <div class="col-sm-7">
                            {{Form::text('sending_ways',null,array('class' => 'form-control', 'readonly' => 'true'))}}
                        </div>
                    </div>
                    @php
                        $receiving_name    = $CustomerComplains[0]->receiving_person_name;
                        $receiving_mobile   = $CustomerComplains[0]->receiving_person_mobile; 
                        $newReceiving_Person   = 'Name : '. $receiving_name . ' '. ','.' '. 'Mobile :'.' '. $receiving_mobile; 
                    @endphp
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-4 ">Person receiving the complainant</label>
                        <div class="col-sm-7">
                            {{Form::text('receiving_person_name',$newReceiving_Person,array('class' => 'form-control', 'readonly' => 'true'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-4 ">Complain Type</label>
                            <div class="col-sm-7">
                                {{Form::text('customercomplaintype_name',$CustomerComplains[0]->customercomplaintype->name,array('class' => 'form-control', 'readonly' => 'true'))}}
                            </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-4 ">Description</label>
                        <div class="col-sm-7">
                            {{Form::textarea('description',null,array('class' => 'form-control max-length','rows' => 4, 'cols' => 4,'maxlength'=>'350', 'readonly' => 'true'))}}
                        </div>
                    </div>
                    @php
                        $batchNo    = $CustomerComplains[0]->batch_no;
                        $Prod_Name   = $CustomerComplains[0]->product->name;
                        $NewBatchNo_Result   =  'Batch No :'.' '. $batchNo . ' '. ','.' '. 'Product Name : '. $Prod_Name; 
                    @endphp
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-4 ">Batch No.</label>
                        <div class="col-sm-7">
                            {{Form::text('batch_no',$NewBatchNo_Result,array('class' => 'form-control', 'readonly' => 'true'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-4 ">Production Date</label>
                            <div class="col-sm-7">
                                {{Form::text('production_date',null,array('class' => 'form-control', 'readonly' => 'true'))}}
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-4 ">Reference Images</label>
                        <div class="col-sm-7">
                            <a href="{{ asset('storage/complainImages/'.$CustomerComplains[0]->file) }}" target="_blank">{{ $CustomerComplains[0]->file }}</a>
                        </div>
                    </div>
                    @if(isset($CustomerComplainLogs[0]))
                    @php
                        $date     = $CustomerComplainLogs[0]->updated_at;
                        $department  = $CustomerComplainLogs[0]->department->name; 
                        $employee  = $CustomerComplainLogs[0]->user->name;
                        $new    = 'Date : '. $date . ' '. ','.' '. 'Dept:'.' '. $department . '    '. 'Acknowledged By :'.' '.$employee; 
                    @endphp
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-4 ">Complaint received by Marketing department and refer to concern department for analysis</label>
                        <div class="col-sm-7">
                            {{Form::textarea('new',$new,array('class' => 'form-control max-length','rows' => 2, 'cols' => 2,'maxlength'=>'350', 'readonly' => 'true'))}}
                        </div>
                    </div>
                    @endif
                    @foreach ($CustomerComplainLogs as $data)
                        @if($data->result_complainant != '')
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="inputName" class="col-sm-4 ">Result of the complainant</label>
                            <div class="col-sm-7">
                                {{Form::textarea('result_complainant',$data->result_complainant,array('class' => 'form-control max-length','rows' => 3, 'cols' => 3,'maxlength'=>'350', 'readonly' => 'true'))}}
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="inputName" class="col-sm-4 ">Corrective action taken</label>
                            <div class="col-sm-7">
                                {{Form::textarea('corrective_action',$data->corrective_action,array('class' => 'form-control max-length','rows' => 3, 'cols' => 3,'maxlength'=>'350', 'readonly' => 'true'))}}
                            </div>
                        </div>
                        @endif
                    @endforeach 
                    @foreach ($CustomerComplainLogs as $data)
                        @if($data->issatisfactory == 'satisfactory')
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="inputName" class="col-sm-4 ">Response of the Complaint.</label>
                            <div class="col-sm-7">
                                {{Form::text('issatisfactory',$data->issatisfactory,array('class' => 'form-control', 'readonly' => 'true'))}}
                            </div>
                        </div>
                    @endif
                    @endforeach
                </div>
            </div>
            @if(isset($CustomerComplainLogs[0]->comments))
            <div class="panel">
                <div class="panel-content">
                    <div class="table-responsive">
                        <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th width="20%">Name</th>
                                <th width="60%">Comments</th>
                                <th width="20%">Date</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php ($i=1)
                                @foreach ($CustomerComplainLogs as $data)
                            <tr>
                                <td>{{$data->user->name or ''}}</td>
                                <td>{{$data->comments or ''}}</td>
                                <td>{{$data->updated_at}}</td>
                            </tr>
                                @php ($i=$i+1)
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
    </div> 
    {{ Form::close() }}
</div>
@endsection

@component('common_pages.selectize')
@include('common_pages.max_length')
<script src="{{ asset('vendor/bootstrap_date-picker/js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript">

        $('.datepicker').datepicker({ format: "dd-mm-yyyy",todayHighlight: true,autoclose:true});

    </script>
    @slot('css')
     <!--Date picker-->
     <link rel="stylesheet" href="{{ asset('vendor/bootstrap_date-picker/css/bootstrap-datepicker3.min.css') }}">
    @endslot
@endcomponent