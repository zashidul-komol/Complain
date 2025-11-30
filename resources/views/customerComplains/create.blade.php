@extends('layouts.admin')

<style type="text/css">
  input:valid {
    background-color: #99ff99;
    border-color: gray;
}
select:valid {
    background-color: #99ff99;
    border-color: gray;
}
select2:valid {
    background-color: #99ff99;
    border-color: gray;
}
textarea:valid {
    background-color: #99ff99;
    border-color: gray;
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
<div class="row animated fadeInRight" style="background-color: gray; text-align: right;">
    {{ Form::model(request()->old(),array('route' =>array('customerComplains.store'), 'enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
    <div class="col-sm-12">
        <h3 align="center"><b> ভোক্তার অভিযোগ রেকর্ড ফর্ম  </b></h3>
        <div class="panel">
            <div class="panel-content">
                <h6 align="center"><b>অভিযোগ গ্রহণকারীর (পোলার প্রতিনিধি ) তথ্য </b></h6>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}" >
                        <label for="inputName" class="col-sm-3 require">অভিযোগ গ্রহণকারীর নাম : </label>
                        <div class="col-sm-7">
                            {{Form::text('receiving_person_name',$employees->name,array('class' => 'form-control' , 'readonly' => 'true'))}}
                            {!! $errors->first('receiving_person_name', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}" >
                        <label for="inputName" class="col-sm-3 require">অভিযোগ গ্রহণকারীর মোবাইল নম্বর : </label>
                        <div class="col-sm-7">
                            {{Form::text('receiving_person_mobile',$employees->mobile,array('class' => 'form-control', 'readonly' => 'true'))}}
                            {!! $errors->first('receiving_person_mobile', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}" >
                        <label for="inputName" class="col-sm-3 require">অভিযোগ গ্রহণকারীর ইমেল : </label>
                        <div class="col-sm-7">
                            {{Form::text('receiving_person_email',$employees->email,array('class' => 'form-control' , 'readonly' => 'true'))}}
                            {!! $errors->first('receiving_person_email', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                </div>
            </div>

        <div class="panel">
            <div class="panel-content">
                <h6 align="center"><b> প্রধান অভিযোগকারীর বিস্তারিত ঠিকানা </b></h6>
                
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-3 require"> প্রধান অভিযোগকারীর নাম: </label>
                        <div class="col-sm-7">
                            {{Form::text('complainant_name',null,array('class' => 'form-control'))}}
                            {!! $errors->first('complainant_name', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-3 require">অভিযোগকারীর মোবাইল নাম্বার : </label>
                        <div class="col-sm-7">
                            {{Form::text('complainant_mobile',null,array('class' => 'form-control'))}}
                            {!! $errors->first('complainant_mobile', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-3 require">অভিযোগকারীর ইমেল : </label>
                        <div class="col-sm-7">
                            {{Form::text('complainant_email',null,array('class' => 'form-control'))}}
                            {!! $errors->first('complainant_email', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-3 require"> বিভাগ : </label>
                            <div class="col-sm-7">
                                {{Form::select('division_id',[''=>'--বিভাগ নির্বাচন করুন --']+$divisions->toArray(),null,array('class' => 'form-control','v-model'=>'division_id', '@change'=>'getDistricts'))}}
                                {!! $errors->first('division_id', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-3 require"> জেলা : </label>
                            <div class="col-sm-7">
                              <select name="district_id" class="form-control col-sm-2" v-model="district_id" @change="getThanas">
                                  <option value="">--জেলা নির্বাচন করুন--</option>
                                  <option v-for="(name,id) in districts" v-bind:value="id" v-text="name"></option>
                              </select>
                              {!! $errors->first('district_id', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-3 require"> থানা : </label>
                            <div class="col-sm-7">
                                <select name="thana_id" v-model="thana_id" class="form-control col-sm-2">
                                    <option value="">--থানা নির্বাচন করুন--</option>
                                    <option v-for="(name,id) in thanas" v-bind:value="id" v-text="name"></option>
                                </select>
                                {!! $errors->first('thana_id', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-3 "> অঞ্চল : </label>
                        <div class="col-sm-7">
                            {{Form::text('area',null,array('class' => 'form-control'))}}
                            {!! $errors->first('title', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-3 require"> ঠিকানা : </label>
                        <div class="col-sm-7">
                            {{Form::textarea('complainant_address',null,array('class' => 'form-control max-length','rows' => 1, 'cols' => 1,'maxlength'=>'350'))}}
                                {!! $errors->first('complainant_address', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel">
            <div class="panel-content">
                <h6 align="center"><b> অভিযোগের বর্ণনা </b></h6>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-3 require">অভিযোগ পাঠানোর মাধ্যম : </label>
                            <div class="col-sm-7">
                               {{Form::select('sending_ways',[''=>'--অভিযোগ পাঠানোর মাধ্যম নির্বাচন করুন--']+['Electronically'=>'Electronically', 'Physically'=>'Physically', 'Field Force'=>'By Field Force', 'Phone Call'=>'By Phone Call'],null,array('class' => 'form-control'))}}
                            {!! $errors->first('sending_ways', '<p class="text-danger">:message</p>' ) !!}
                                        
                            </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-3 ">অভিযোগের বিভাগ : </label>
                        <div class="col-sm-7">
                            {{Form::select('complain_catId',[''=>'--অভিযোগের বিভাগ নির্বাচন করুন--']+$comlainCategories->toArray(),null,array('class' => 'form-control','data-placeholder'=>'Please Select Category of Complaint'))}}
                        </div>
                    </div>
                                    
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-3 ">পণ্যের ধরণ/ বিভাগ : </label>
                        <div class="col-sm-7">
                            {{Form::select('complain_subcatId',[''=>'--অভিযোগের বিভাগ নির্বাচন করুন--']+$comlainSubCategories->toArray(),null,array('class' => 'form-control','data-placeholder'=>'Please Select Category of Complaint'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-3 require">অভিযোগের প্রাথমিক উৎস : </label>
                            <div class="col-sm-7">
                               {{Form::select('primary_source',[''=>'--অভিযোগ প্রাথমিক উৎস নির্বাচন করুন--']+['At The Depot Point'=>'At The Depot Point', 'At The Dealer Point'=>'At The Dealer Point', 'At The Retailer Point'=>'At The Retailer Point', 'At The Consumer Residence Point'=>'At The Consumer Residence Point'],null,array('class' => 'form-control'))}}
                            {!! $errors->first('primary_source', '<p class="text-danger">:message</p>' ) !!}
                                        
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-3 require">অভিযোগের ধরণ : </label>
                            <div class="col-sm-7">
                               <select id="customercomplaintype_id" name="customercomplaintype_id" class="form-control select2" >

                                    @foreach ($comlainTypes as $key => $value)
                                       
                                    <option id= "{{ $key }}" value="{{  $key }}">

                                        {{ $value }}

                                    </option>
                                    {!! $errors->first('{{ $key }}', '<p class="text-danger">:message</p>' ) !!}

                                    @endforeach    

                                </select>
                            </div>
                            
                    </div>
                    
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}" id='override_membership_price' hidden="true">
                        <label for="inputName" class="col-sm-3 ">অন্য অভিযোগ : </label>
                        <div class="col-sm-7" >
                            {{Form::text('othersComplain',null,array('class' => 'form-control'))}}
                            {!! $errors->first('title', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-3 require">অভিযোগের বর্ণনা : </label>
                        <div class="col-sm-7">
                            {{Form::textarea('description',null,array('class' => 'form-control max-length','rows' => 3, 'cols' => 2,'maxlength'=>'500'))}}
                                {!! $errors->first('description', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                    
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-3 require">পণ্যের নাম : </label>
                        <div class="col-sm-7">
                            {{Form::select('product_id',[''=>'--পণ্য নির্বাচন করুন--']+$products->toArray(),null,array('class' => 'form-control select2','data-placeholder'=>'Please Select Product'))}}
                            {!! $errors->first('product_id', '<p class="text-danger">:message</p>' ) !!}

                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('batch_no') ? ' has-error' : '' }}">
                        <label for="inputName" class="col-sm-3 require">ব্যাচ নাম্বার : </label>
                        <div class="col-sm-7">
                            {{Form::text('batch_no',null,array('class' => 'form-control'))}}
                            {!! $errors->first('batch_no', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-3 require">প্রস্তুতকরণ তারিখ : </label>
                            <div class="col-sm-7">
                                <div class="input-group">
                                  <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                    {{Form::text('production_date',null,array('class' => 'form-control datepicker', 'readonly' => 'true'))}}
                                    {!! $errors->first('production_date', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>  
                            
                    </div>
                    {{ optional($comlainTypes->first())->name }}
                    <div class="form-group">
                        <label for="inputName" class="col-sm-3 ">রেফারেন্স ইমেজ : </label>
                        <div class="col-sm-7">
                            <div class="input-group">
                              <input type="file" name="file" > 
                            </div>
                        </div>
                    </div>
                    <div class="form-group" >
                          <div class="col-sm-offset-4 col-sm-3">
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

        $('.datepicker').datepicker({ format: "yyyy-mm-dd",todayHighlight: true,autoclose:true});

    </script>
    @slot('css')
     <!--Date picker-->
     <link rel="stylesheet" href="{{ asset('vendor/bootstrap_date-picker/css/bootstrap-datepicker3.min.css') }}">
    @endslot

    <script>
          
         function DropDownList()
        {
            var state=document.getElementById("othersType").value;
            //alert(state);
            if(state=="Others"){
                document.getElementById("override_membership_price").style.visibility='visible';   
            }else{
                document.getElementById("override_membership_price").style.visibility='hidden';
            }
        }

        $(document).ready(function () {
            $("#customercomplaintype_id").on('change',function () {
            //alert ($(this).val());
            var data = ($(this).val());
                       
            if (data == '20') {
                $('#override_membership_price').show();

            } else {
                 $('#override_membership_price').hide();
            }
           });
        }); 
</script>
@endcomponent