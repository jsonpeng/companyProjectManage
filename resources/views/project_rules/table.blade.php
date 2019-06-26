<table class="table table-responsive" id="projectRules-table">
    <thead>
        <tr>
            <th>Basic Cost</th>
        <th>First Price</th>
        <th>First Prop</th>
        <th>Second Prop</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($projectRules as $projectRules)
        <tr>
            <td>{!! $projectRules->basic_cost !!}</td>
            <td>{!! $projectRules->first_price !!}</td>
            <td>{!! $projectRules->first_prop !!}</td>
            <td>{!! $projectRules->second_prop !!}</td>
            <td>
                {!! Form::open(['route' => ['projectRules.destroy', $projectRules->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('projectRules.show', [$projectRules->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('projectRules.edit', [$projectRules->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>