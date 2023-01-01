<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Full name</th>
        <th>Mobile</th>
        <th>Email</th>
        <th>Message</th>
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
        <tr>
            <td scope="row">{{$num}}</td>
            <td>{{$value->fullName}}</td>
            <td>{{$value->number}}</td>
            <td>{{$value->email}}</td>
            <td>{{\Illuminate\Support\Str::limit($value->message, 10), '...'}}</td>
            <td>@if($value->status== 'read')<i id="{{$value->id}}" class='fa fa-eye text-success'> Read</i> @else <i id="{{$value->id}}" class='fa fa-eye-slash text-danger'> Unread</i>@endif</td>
            <td><a href="{{route('ShowDetails',$value->id)}}"><i class="fa fa-eye text-primary" title="Show details"></i> </a>
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
            {{--    {!! $values->appends(['sort' => 'title'])->links() !!}--}}
            {{$values->links()}}
        </div>
    </div>
</div>
