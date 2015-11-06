@foreach(DbConfig::get( $item['field'], [] ) as $key=>$value)
<div class="form-group row form-layout">
    <div class="col-md-5">
        <input type="text" name="field[{{ $item['field'] }}][]" value="{{ $value }}" class="form-control">
    </div>
    <div class="col-md-5">
        <input type="text" name="comment[{{ $item['field'] }}][]" value="{{ DbConfig::get( $item['field'].'_comment.'.$key ) }}" class="form-control" placeholder="Comment">
    </div>
    <div class="col-md-1">
        <a href="#" class="btn btn-warning btn-remove">
            <i class="glyphicon glyphicon-remove"></i>
        </a>
    </div>
</div>
@endforeach
