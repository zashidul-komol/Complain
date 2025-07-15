@extends('layouts.admin')
@section('title', 'Complain Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Complain</a></li>
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>
<div class="tabs">
    <ul class="nav nav-tabs">
        <li class="{{'active'}}"><a href="{{ route('customerComplains.index') }}">New</a></li>
        <li><a href="{{ route('customerComplains.processing') }}">Processing</a></li>
        <li><a href="{{ route('customerComplains.completed') }}">Completed</a></li>
    </ul>
</div>

<div class="row animated fadeInRight">
    <div class="col-sm-12">
       <h4 class="section-subtitle"><b>Complain Lists</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('customerComplains.create','<i class="fa fa-plus"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
				      <div class="table-responsive">
                <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>SI</th>
                        <th>Complainant Name</th>
                        <th>Mobile</th>
                        <th>Region</th>
                        <th>District</th>
                        <th>Area</th>
                        <th>Complain Type</th>
                        <th>Ticket Number</th>
                        <th>Complain Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php ($i=1)
                        @foreach ($CustomerComplains as $data)
                      <tr>
                        <td>{{$i}}</td>
                      	<td>{{$data->complainant_name or ''}}</td>
                        <td>{{$data->complainant_mobile or ''}}</td>
                        <td>{{$data->region->name or ''}}</td>
                        <td>{{$data->district->name or ''}}</td>
                        <td>{{$data->area or ''}}</td>
                        <td>{{$data->customercomplaintype->name or ''}}</td>
                        <td>{{$data->id or ''}}</td>
                        <td>{{$data->complain_date or ''}}</td>
                        <td>
                          {!!  Html::decode(link_to_route('customerComplains.viewCustomerComplain', '<span aria-hidden="true" class="fa fa-eye fa-x"></span>', array($data->id)))!!}
                          
                        </td>
                      </tr>
                        @php ($i=$i+1)
                        @endforeach
                    </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
@component('common_pages.data_table_script')
<script>
  $(function(){
      "use strict";
      $('.data-table').DataTable({
        "order": [], /* No ordering applied by DataTables during initialisation */
      });
  });
</script>
@endcomponent

