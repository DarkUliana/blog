<div class="custom-file {{ $errors->has('image') ? 'has-error' : ''}}" style="margin-bottom: 20px">
    <label for="image" class="custom-file-label">{{ 'Image' }}</label>
    <input class="custom-file-input" name="image" type="file" id="image" value="{{ isset($post) ? $post->image : ''}}" >
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Title' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($post) ? $post->title : ''}}" maxlength="255">
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('text') ? 'has-error' : ''}}">
    <label for="text" class="control-label">{{ 'Text' }}</label>
    <textarea class="form-control" rows="5" name="text" type="textarea" id="text" maxlength="65535">{{ isset($post) ? $post->text : ''}}</textarea>
    {!! $errors->first('text', '<p class="help-block">:message</p>') !!}
</div>
<input type="hidden" name="user_id" value="{{ $user->id }}">


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
