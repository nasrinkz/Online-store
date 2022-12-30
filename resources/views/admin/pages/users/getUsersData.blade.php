<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Full name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th>Operations</th>
    </tr>
    </thead>
    <tbody>
    @if ($values->isEmpty())
        <tr class="odd text-center"><td valign="top" colspan="4" >No matching records found</td></tr>
    @endif
    @php($num=1)
    @foreach($values as $value)
        @if($value->status==1)
            <?php $next_status=0; ?>
        @else
            <?php $next_status=1;?>
        @endif
        <tr>
            <td scope="row">{{$num}}</td>
            <td>{{$value->FullName}}</td>
            <td>{{$value->email}}</td>
            <td>{{$value->userGroup->role}}</td>
            <td><a href="javascript:" id="{{$next_status}}" rel="{{url('AdminDashboard/ChangeUserStatus',$value->id)}}/" onClick="changeShow(this);">@if($value->status== 1)<i id="{{$value->id}}" class='fa fa-check text-success'> Enable</i> @else <i id="{{$value->id}}" class='fa fa-ban text-danger'> Disable</i>@endif </a></td>
            <td><a href="{{route('EditUser',$value->id)}}"><i class="fa fa-edit text-primary" title="Edit"></i> </a>
                <a href="{{route('EditUserAddress',$value->id)}}"><i class="fa fa-map-marked text-primary" title="Address"></i> </a>
                <a href="{{route('DestroyUser',$value->id)}}"><i class="fa fa-trash text-danger" title="Delete"></i> </a>
            </td>
        </tr>
        @php($num++)
    @endforeach
    </tbody>
</table>
<div class="row">
    <div class="col-sm-12 col-md-5">
        <div class="dataTables_info" aria-live="polite">
            {{$dataTableInfo}}
        </div>
    </div>
    <div id="pagination" class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_simple_numbers">
            {{$values->links()}}
        </div>
    </div>
</div>
