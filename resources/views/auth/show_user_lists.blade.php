@extends('layouts.admin')
@section('title', 'User Lists')
@section('content')
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">User</a></li>
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<!--SEARCHING, ORDENING & PAGING-->
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>User Lists</b></h4>
        <span class="pull-right">
          {!! Html::decode(link_to_route('users.download','<i class="fa fa-download" aria-hidden="true"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
            {!! Html::decode(link_to_route('register','<i class="fa fa-plus"></i>',[],array('class'=>'btn btn-success','style'=>'margin-bottom:10px'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
                <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="98%">
                        <thead>
                          <tr>
                            <th class="no-sort">Name</th>
                            <th class="no-sort">Email</th>
                            <th class="no-sort">Mobile</th>
                            <th>Username</th>
                            <th>Region</th>
                            <th>Designation</th>
                            <th>Role</th>
                            <th class="no-sort">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php ($i=1)
                          @foreach ($users as $data)
                            <tr>
                            <td>{{$data->name ?? ''}}</td>
                            <td>{{$data->email}}</td>
                            <td>{{$data->mobile}}</td>
                            <td>{{$data->username ?? ''}}</td>
                            <td>{{$data->region->name ?? ''}}</td>
                            <td>{{$data->designation->title ?? ''}}</td>
                            <td>{{$data->role->name ?? ''}}</td>
                            
                            <td>
                            	 {!!  Html::decode(link_to_route('password.changeUserPassword', '<span aria-hidden="true" class="fa fa-key fa-x"></span>', array($data->id)))!!}
                                 {!!  Html::decode(link_to_route('users.edit', '<span aria-hidden="true" class="fa fa-edit fa-x"></span>', array($data->id)))!!}
                                 <span class="delete-form">
                                     <button type="button" data-toggle="modal" data-target="#myModal" onClick="callModal('{{$data->id}}')" class='btn btn-xs delete-button'><span aria-hidden="true" class="fa fa-remove"></span></button>
                                  </span>
                            </td>
                          </tr>
                          @php ($i=$i+1)
                        @endforeach
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Select any role for all the users under this role</h4>
      </div>
      {{ Form::open(array('route' => array('users.destroy', 'remove-id'),'method'=>'DELETE','id'=>'del-form')) }}
      <div class="modal-body">
        {{Form::select('user_id',[],null,array('class' => 'form-control', 'id'=>'selectBox'))}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        {{ Form::submit('Confirm Delete',array('class'=>'btn btn-primary'))}}
      </div>
      {{ Form::close() }}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
@endsection

@component('common_pages.data_table_script')
<script>
  $(function(){
      "use strict";
      $('.data-table').DataTable({
        "order": [], /* No ordering applied by DataTables during initialisation */
        "pageLength": 25,
         "columnDefs": [ {
            "targets": 'no-sort',
            "orderable": false,
            "order": []
          } ]
      });
  });
</script>
@slot('css')
  <style>
    table.dataTable.nowrap th, table.dataTable.nowrap td{
      white-space: pre-wrap
    }
  </style>
@endslot
@endcomponent



