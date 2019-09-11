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
            <input type="hidden" name="tab" value="tab-{{ $slug }}">
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
            <br>
            <div class="row">
            @foreach($tab['items'] as $item)
            <div class="col-md-6">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-7">
                            <label>{{ $item['label'] }}</label>
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="#" class="btn btn-sm btn-info btn-add top">Add item</a>
                        </div>
                    </div>
                    <br>
                    <div class="fieldBlock" id="fieldBlock-{{ $item['type'] }}">
                        @include('dbConfigAdmin::fields.'.$item['type'], key_exists('data', $item) ? $item['data'] : [])
                    </div>
                    <a href="#" class="btn btn-sm btn-info btn-add bottom">Add item</a>
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

<script>if (!window.jQuery) { document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"><\/script>'); }</script>
<script>
(function($){
    $("#settingsTabs a:first").tab('show');
    $('#settingsTabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
    $(".btn-add").click(function(e){
        e.preventDefault();
        var fieldBlock = $(this).closest('.form-group').find('.fieldBlock');
        var layout   = fieldBlock.find('.form-group').first().clone();
        var next_key = parseInt(layout.find('input').attr('name').replace(/^.*\[(\d+)\](\[\])?$/, '$1')) + 1;

        layout.find('input,select,checkbox,textarea').each(function(){
            var input = $(this);
            input.val('').attr('value', '');
            var input_name = input.is('select')
                ? input.attr('name').replace(/\[\d+\]\[\]$/g, '[' + next_key + '][]')
                : input.attr('name').replace(/\[\d+\]$/g, '[' + next_key + ']');

            input.attr('name', input_name);
        });

        if($(this).hasClass('bottom'))
            fieldBlock.append(layout);
        else
            fieldBlock.prepend(layout);
    });
    $(document).on('click', '.btn-remove', function(e){
        e.preventDefault();
        $(this).closest('.form-group').remove();
    });

    var hash = location.hash;
    if($('a[href="'+hash+'"]').length) {
        $('a[href="'+hash+'"]:first').tab('show');
    }
})(jQuery);
</script>
@stop