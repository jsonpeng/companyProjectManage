<table class="table table-responsive" id="projects-table">
    <thead>
        <tr>
        <th>项目名称</th>
        <th>项目类型</th>
        <th>参与人员</th>
        <th>计划开始时间</th>
        <th>计划结束时间</th>
        <th>项目金额</th>
        <th>由**产品转换</th>
        <th>当前状态</th>
        <th>项目实际结束时间</th>
        <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($projects as $project)
        <tr>
            <td>{!! $project->name !!}</td>
            <td>{!! $project->type !!}</td>
            @if($project->users()->count()>0)
            <td>@foreach($project->users()->get() as $users)<a style="margin-left:5px;" href="{!! route('users.info', [$users->id]) !!}">{!! $users->name !!}</a>@endforeach</td>
            @else
            <td>--</td>
            @endif
            <td>{!! $project->start_time !!}</td>
            <td>{!! $project->end_time !!}</td>
            <td>{!! $project->price !!}</td>
            <td> @if($project->products()->count()>0)<a href="{!! route('products.show', [$project->products()->first()->id]) !!}">{!! $project->products()->first()->name !!}</a>@else--@endif</td>
            <td><a class="@if($project->status=='结束')btn btn-success @elseif($project->status=='延期') btn btn-danger @elseif($project->status=='进行')btn btn-primary @else btn btn-default @endif btn-sm">{!! $project->status !!}</a></td>
            <td>{!! empty($project->basic_time)?'--':$project->basic_time !!}</td>
            <td>
                {!! Form::open(['route' => ['projects.destroy', $project->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('projects.show', [$project->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('projects.edit', [$project->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除该项目吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>