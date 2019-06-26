<table class="table table-responsive" id="products-table">
    <thead>
        <tr>
        <th>产品名称</th>
        <th>所在产品分类</th>
        <th>参与人员</th>

        <th>是否已转换为项目</th>
        <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($products as $products)
        <tr>
            <td><a href="{!! route('products.show', [$products->id]) !!}">{!! $products->name !!}</a></td>
            <td><a href="{!! route('productcats.edit', [$products->cats()->first()->id]) !!}">{!! $products->cats()->first()->name !!}</a></td>
            @if($products->users()->count()>0)
            <td>@foreach($products->users()->get() as $users)<a style="margin-left:5px;" href="@if(Auth::user()->is_admin=='是'){!! route('users.info', [$users->id]) !!} @else javascript:; @endif">{!! $users->name !!}</a>@endforeach</td>
   
            @else
            <td>--</td>
    
            @endif
            <td>{!! $products->whether_project=='是'?'是':'否' !!}</td>
            <td>
                {!! Form::open(['route' => ['products.destroy', $products->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('products.show', [$products->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('products.edit', [$products->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除该产品吗?')"]) !!}
                    <a href="javascript:;" class="btn p-follow-btn btn-xs" data-productid="{!! $products->id !!}" id="productToProject">快速转化为项目</a>
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>