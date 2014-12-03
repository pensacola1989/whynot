<div class="page-header">
    <h2>
        志愿者签名
    </h2>
</div>
<div class="container">
 <table class="table-list table table-hover">
        <thead>
        <tr>
            <th>姓名</th>
            <th>电话</th>
            <th>邮箱</th>
            <th>志愿者信息查看</th>
        </tr>
        </thead>
        <tbody>
        @if(count($attendWithPivot))
        @foreach($attendWithPivot as $attendee)
        <tr>
            <td>{{ $attendee->volunteer_name }}</td>
            <td>{{ $attendee->volunteer_mobile }}</td>
            <td>{{ $attendee->volunteer_email }}</td>
            <td>
                <a class="modify-time" id="{{ $attendee->id }}" href="javascript:void(null)"
                    data-toggle="tooltip" data-placement="top" title="" data-original-title="查看">
                    <i class="fa fa-eye"></i>
                </a>
            </td>
        </tr>
        @endforeach
        @endif
        </tbody>
    </table>
    <nav class="pager-container">

      {{--{{ $attendWithPivot->links() }}--}}
    </nav>
</div>