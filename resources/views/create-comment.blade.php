<form method="POST" action="{{ url('comment') }}" accept-charset="UTF-8"
      class="form-horizontal {{ isset($parent) ? 'mt-3' : '' }}" enctype="multipart/form-data">
    {{csrf_field()}}
    <input name="post_id" type="hidden" value="{{ $post->id }}">
    @isset($parent)
        <input type="hidden" name="parent_id" value="{{ $parent }}">
    @endisset
    <textarea name="text" class="form-control"></textarea>
    <button type="submit" class="btn btn-sm btn-info mt-3">Відправити</button>
</form>
