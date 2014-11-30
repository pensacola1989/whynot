<div class="page-header">
    <h2>
        志愿者评价
    </h2>
</div>
<div class="container">
    <table class="table-list table table-hover">
        <thead>
        <tr>
            <th>姓名</th>
            <th>电话</th>
            <th>邮箱</th>
            <th>活动时间</th>
            <th>参与评价</th>
        </tr>
        </thead>
        <tbody>
        @if(count($attendWithPivot))
        @foreach($attendWithPivot as $attendee)
        <tr>
            <td>{{ $attendee->volunteer_name }}</td>
            <td>{{ $attendee->volunteer_mobile }}</td>
            <td>{{ $attendee->volunteer_email }}</td>
            <td>{{ 10 }}</td>
            <td></td>
        </tr>
        @endforeach
        @endif
        </tbody>
    </table>
</div>