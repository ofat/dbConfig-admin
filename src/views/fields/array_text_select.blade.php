<div class="well">
    <div class="row">
        <div class="col-md-8">
            {{ Form::text('token', '', ['id'=>'newTokenTxt', 'class'=>'form-control', 'placeholder'=>'Generate sample token here...', 'autocomplete' => 'off']) }}
        </div>
        <div class="col-md-4">
            {{ Form::button('Generate', ['id'=>'generateTokenBtn', 'class'=>'form-control btn btn-primary']) }}
        </div>
    </div>
</div>
<br>
<div class="clearfix"></div>
<script>
    document.getElementById("generateTokenBtn").onclick = function generateToken(){
        document.getElementById("newTokenTxt").value = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
    }
</script>

@foreach(DbConfig::get( $item['field'], ['0'=>''] ) as $key=>$value)
    <?php
    $select_values = DbConfig::get($item['field'] . '_select.' . $key);
    $comment       = DbConfig::get($item['field'] . '_comment.' . $key);
    ?>

<div class="form-group row form-layout">
    <div class="well">
        <div class="col-md-6">
            <input type="text" name="field[{{ $item['field'] }}][{{$key}}]" value="{{ $value }}" class="form-control" placeholder="Token">
            <br>
            <input type="text" name="comment[{{{ $item['field'] }}}][{{$key}}]" value="{{{ $comment }}}" class="form-control" placeholder="Comment">
        </div>
        <div class="col-md-4">
            {{ Form::select("select[".$item['field']."][".$key."][]", $select_defaults, $select_values, ['class' => 'form-control', 'multiple' => 'true', 'size'=>4]) }}
        </div>
        <div class="col-md-1">
            <a href="#" class="btn btn-warning btn-remove">
                <i class="glyphicon glyphicon-remove"></i>
            </a>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@endforeach
