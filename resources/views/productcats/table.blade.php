<table class="table table-responsive" id="productcats-table">
    <thead>
        <tr>
        <th>产品分类名称</th>
        <th>产品分类描述</th>
        <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($productcats as $productcats)
        <tr>
            <td>{!! $productcats->name !!}</td>
            <td>{!! $productcats->des !!}</td>
            <td>
                {!! Form::open(['route' => ['productcats.destroy', $productcats->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('productcats.show', [$productcats->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('productcats.edit', [$productcats->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>