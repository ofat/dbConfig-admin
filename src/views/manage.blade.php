@extends($layout)

@section('title')
    Settings - {{ $page['name'] }}
@stop

@section('main')
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist" id="settingsTabs">
        @foreach($page['tabs'] as $slug=>$tab)
        <li role="presentation"><a href="#tab-{{ $slug }}" role="tab" data-toggle="tab"><?=$tab['name']?></a></li>
        @endforeach
    </ul>
<p>&nbsp;</p>
    <!-- Tab panes -->
    <div class="tab-content">
        @foreach($page['tabs'] as $slug=>$tab)
        <div role="tabpanel" class="tab-pane" id="tab-{{ $slug }}">
            {{ Form::open(['route' => 'dbConfigAdmin.store']) }}
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
            <div class="row">
            @foreach($tab['items'] as $item)
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ $item['label'] }}</label>
                    @include('dbConfigAdmin::fields.'.$item['type'])
                </div>
            </div>
            @endforeach
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
        @endforeach
    </div>

<script>
(function($){
    $("#settingsTabs a:first").tab('show');
    $('#settingsTabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    })
})(jQuery);
</script>
@stop