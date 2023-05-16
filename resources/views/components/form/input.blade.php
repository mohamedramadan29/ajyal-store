<input type="{{$type}}"
       @class(['form-control','is-invalid'=>$errors->has($name)]) id="name" name={{$name}} value="{{old($name,$value)}}">
@error($name)
<div class="invalid-feedback">
    {{$message}}
</div>
@enderror
