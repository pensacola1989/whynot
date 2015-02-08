<div class="page-header">
    <h2>
        志愿者自定义信息详情
        &nbsp;
        <i class="fa fa-angle-double-right"></i>
        &nbsp;

    </h2>
</div>
<div class="container">
    <form action="" class="hgy-form form-horizontal">
    @if($attributes && $values)
    @foreach($attributes as $attr)
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">{{ $attr->attr_name }}</label>
        <div class="col-sm-10">
            @if(!empty($values[$attr->attr_field_name]))
            @if($attr->attr_type == 'text')
            {{ $values[$attr->attr_field_name]}}
            @elseif($attr->attr_type == 'image')
            {{ $values[$attr->attr_field_name]}}
            @elseif($attr->attr_type == 'textarea')
            @elseif($attr->attr_type == 'datetime')
            @endif
            @endif
        </div>
    </div>
    @endforeach
    @endif
    <div class="form-group">
        <div class="col-sm-10">
            <button type="submit" onclick="javascript:window.history.go(-1);" class="btn btn-default">
                <i class="fa fa-arrow-left"></i>
                返回
            </button>
        </div>
    </div>
    </form>
</div>
