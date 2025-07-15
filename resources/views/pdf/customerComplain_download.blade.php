<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="{{ public_path().'/css/pdf.min.css' }}">


</head>
<body>
 <table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="30%">
        <img class="profile-user-img img-responsive img-circle" src="{{public_path('images/PolarLogoBangla.png')}}" />
    </td>
    <td width="55%">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><h4>DHAKA ICE CREAM INDUSTRIES LIMITED.</h4></td>
          </tr>
          <tr>
            <td align="center"><h4>CUSTOMER COMPLAINT RECORD FORM</h4></td>
          </tr>
        </table>
    </td>
    <td colspan="2" width="15%" align="center">Doc : MKT/CIF/{{$CustomerComplains[0]->id}}</td>
  </tr>
  <tr>
    <td height="25">Date of receiving of the complaint</td>
    <td colspan="3">{{ $CustomerComplains[0]->complain_date or '' }}</td>
  </tr>
  <tr>
    <td height="24">Name of the Complainant</td>
    <td colspan="3">{{ $CustomerComplains[0]->complainant_name or '' }}</td>
  </tr>
  
  <tr>
    <td height="35">Address complainant Personnel</td>
    <td colspan="3">{{ $newAddress or '' }}</td>
  </tr>
  
  <tr>
    <td height="24">Email complainant Personnel</td>
    <td colspan="3">{{ $CustomerComplains[0]->complainant_email or '' }}</td>
  </tr>
  <tr>
    <td height="23">Telephone number of the Complainant</td>
    <td colspan="3">{{ $CustomerComplains[0]->complainant_mobile or '' }}</td>
  </tr>
  
  <tr>
    <td height="22">Ways of Sending the Complaint</td>
    <td colspan="3">{{ $CustomerComplains[0]->sending_ways or '' }}</td>
  </tr>
  <tr>
    <td height="24">Person receiving the complainant</td>
    <td colspan="3">{{ 'Name :' . ' '. $CustomerComplains[0]->receiving_person_name . ' '. ','. ''. 'Mobile : '.  $CustomerComplains[0]->receiving_person_mobile }}</td>
  </tr>
  <tr>
    <td height="64">Description of the Complainant</td>
    <td colspan="3">{{ $CustomerComplains[0]->description .','. ' '. 'Batch No : '. $CustomerComplains[0]->batch_no . ' '. ','. ' '. 'Production Date :'. ''. $CustomerComplains[0]->production_date }}</td>
  </tr>
  @if(isset($CustomerComplainLogs[0]))
    @php
        $date     = $CustomerComplainLogs[0]->updated_at;
        $department  = $CustomerComplainLogs[0]->department->name; 
        $employee  = $CustomerComplainLogs[0]->user->name;
        $new    = 'Date : '. $date . ' '. ','.' '. 'Dept:'.' '. $department . '    '. 'Forward By :'.' '.$employee; 
    @endphp
  <tr>
    <td height="40">Complaint received by Marketing department and refer to concern department for analysis</td>
    <td colspan="3">{{$new}}</td>
  </tr>
  @endif
  @foreach ($CustomerComplainLogs as $data)
    @if($data->result_complainant != '')
  <tr>
    <td height="60">Result of the complainant</td>
    <td colspan="3">{{$data->result_complainant}}</td>
  </tr>
  <tr>
    <td height="50">Corrective action taken</td>
    <td colspan="3">{{$data->corrective_action}}</td>
  </tr>
  @endif
    @endforeach 
    @foreach ($CustomerComplainLogs as $data)
        @if($data->issatisfactory == 'satisfactory')
  <tr>
    <td height="28">Response of the Complaint.</td>
    <td colspan="3">{{$data->issatisfactory}}</td>
  </tr>
  @endif
    @endforeach
    @if(isset($CustomerComplainLogs[0]))
    @php
        $date     = $CustomerComplainLogs[0]->updated_at;
        $department  = $CustomerComplainLogs[0]->department->name; 
        $employee  = $CustomerComplains[0]->receiving_person_name;
        $new    = 'Date : '. $date . ' '. ','.' '. 'Dept:'.' '. $department . '    '. ', '. 'Acknowledged By :'.' '.$employee; 
    @endphp
    @foreach ($CustomerComplainLogs as $data)
        @if($data->response_complainant == 'agree')
  <tr>
    <td height="55">Report forward to Brand department for further communication</td>
    <td colspan="3">{{$new}}</td>
  </tr>
   @endif
    @endforeach 
    @endif
</table>
<table>
    <tr>
        <td>Note : This is a computer generated process, so no required any signature.</td>
    </tr>
    <tr>
        <td>Complain Number : {{$CustomerComplains[0]->id or ''}}</td>
    </tr>
</table>
</body>
</html>