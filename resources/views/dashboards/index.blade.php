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
@section('title', 'Apply For Complain')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Complain</a></li>
            <li><a>Apply For Complain</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    {{ Form::model(request()->old(),array('route' =>array('customerComplains.store'), 'enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
    <div class="col-sm-8">
        <h3 align="center"><b>CUSTOMER COMPLAINT RECORD FORM</b></h3>
        <div class="panel">
            <div class="panel-content">
                
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-4 require">Name of the Complainant</label>
                        <div class="col-sm-7">
                            {{Form::text('complainant_name',null,array('class' => 'form-control'))}}
                            {!! $errors->first('complainant_name', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-4 require">Complainant Personnel Mobile</label>
                        <div class="col-sm-7">
                            {{Form::text('complainant_mobile',null,array('class' => 'form-control'))}}
                            {!! $errors->first('complainant_mobile', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-4 ">Complainant Personnel Email</label>
                        <div class="col-sm-7">
                            {{Form::text('complainant_email',null,array('class' => 'form-control'))}}
                            {!! $errors->first('title', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                    <h6 class="section-subtitle"><b>Complainant Personnel Address : </b></h6>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-4 ">Division</label>
                            <div class="col-sm-7">
                                {{Form::select('division_id',[''=>'--Please Select Division--']+$divisions->toArray(),null,array('class' => 'form-control','v-model'=>'division_id', '@change'=>'getDistricts'))}}
                                {!! $errors->first('division_id', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-4 ">District</label>
                            <div class="col-sm-7">
                              <select name="district_id" class="form-control col-sm-2" v-model="district_id" @change="getThanas">
                                  <option value="">--Please Select District--</option>
                                  <option v-for="(name,id) in districts" v-bind:value="id" v-text="name"></option>
                              </select>
                              {!! $errors->first('district_id', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-4 ">Thana</label>
                            <div class="col-sm-7">
                                <select name="thana_id" v-model="thana_id" class="form-control col-sm-2">
                                    <option value="">--Please Select Thana--</option>
                                    <option v-for="(name,id) in thanas" v-bind:value="id" v-text="name"></option>
                                </select>
                                {!! $errors->first('thana_id', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-4 ">Area</label>
                        <div class="col-sm-7">
                            {{Form::text('area',null,array('class' => 'form-control'))}}
                            {!! $errors->first('title', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-4 require">Address</label>
                        <div class="col-sm-7">
                            {{Form::textarea('complainant_address',null,array('class' => 'form-control max-length','rows' => 1, 'cols' => 1,'maxlength'=>'350'))}}
                                {!! $errors->first('complainant_address', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-4 require">Ways of Sending the Complaint</label>
                            <div class="col-sm-7">
                               {{Form::select('sending_ways',[''=>'--Please Select Ways--']+['Electronically'=>'Electronically', 'Physically'=>'Physically', 'Field Force'=>'By Field Force', 'Phone Call'=>'By Phone Call'],null,array('class' => 'form-control','onchange'=>'showItemList(this.value)'))}}
                            {!! $errors->first('sending_ways', '<p class="text-danger">:message</p>' ) !!}
                                        
                            </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}" >
                        <label for="inputName" class="col-sm-4 require">Person Receiving the Complaint</label>
                        <div class="col-sm-7">
                            {{Form::text('receiving_person_name',null,array('class' => 'form-control'))}}
                            {!! $errors->first('receiving_person_mobile', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}" >
                        <label for="inputName" class="col-sm-4 require">Receiving Person Mobile No.</label>
                        <div class="col-sm-7">
                            {{Form::text('receiving_person_mobile',null,array('class' => 'form-control'))}}
                            {!! $errors->first('receiving_person_mobile', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-4 require">Complain Type</label>
                            <div class="col-sm-7">
                               {{Form::select('customercomplaintype_id',[''=>'--Please Select Complain Type--']+$comlainTypes->toArray(),null,array('class' => 'form-control'))}} 
                               {!! $errors->first('customercomplaintype_id', '<p class="text-danger">:message</p>' ) !!}
                                        
                            </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-4 require">Description</label>
                        <div class="col-sm-7">
                            {{Form::textarea('description',null,array('class' => 'form-control max-length','rows' => 2, 'cols' => 2,'maxlength'=>'350'))}}
                                {!! $errors->first('description', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-4 ">Batch No.</label>
                        <div class="col-sm-7">
                            {{Form::text('batch_no',null,array('class' => 'form-control'))}}
                            {!! $errors->first('title', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-4 ">Production Date</label>
                            <div class="col-xs-4">
                                <div class="input-group">
                                  <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                    {{Form::text('production_date',null,array('class' => 'form-control datepicker'))}}
                                </div>
                            </div>  
                            
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-4 ">Reference Images</label>
                        <div class="col-xs-4">
                            <div class="input-group">
                              <input type="file" name="file" > 
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="input-group">
                              <a >Max File Size= 1 MB</a> 
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                          <div class="col-sm-offset-4 col-sm-8">
                            <button type="submit" class="btn btn-primary"> Submit Application</button>
                          </div>
                    </div>
            </div>
        </div>
    </div> 
    {{ Form::close() }}
</div>
@endsection
@section('vuescript')
<script>
    laravelObj.division_id='{{ old('division_id') }}';
    laravelObj.district_id='{{ old('district_id') }}';
    laravelObj.thana_id='{{ old('thana_id') }}';
</script>
@stop

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

    <script>
  var call=false;
        function showItemList(val){
            if(val=='External'){
                call=true;
                $('#current-df').html('<select name="current_df" class="form-control"><option value="" selected="selected">Please select current DF</option></select>');
                $('#current-df-wraper').removeClass('hidden');
                $('#comment-wraper').removeClass('hidden');
                if (shopId){
                    getCurrentDfs(shopId);
                }
            }else{
                call=false;
               $('#current-df-wraper').addClass('hidden');
               $('#comment-wraper').addClass('hidden');
            }
        }

        if('{{old('type')}}'){
            showItemList('{{old('type')}}');
        }       
</script>
@endcomponent