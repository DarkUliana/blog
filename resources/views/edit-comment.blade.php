<form method="POST" accept-charset="UTF-8"
      class="form-horizontal mt-2" enctype="multipart/form-data">
    {{--{{ method_field('PATCH') }}--}}
    {{--{{csrf_field()}}--}}
    <input name="post_id" type="hidden" value="{{ $comment->post_id }}">

    <input name="id" type="hidden" value="{{ $comment->id }}">

    <textarea name="text" class="form-control">{{ isset($comment) ? $comment->text : '' }}</textarea>
    <button type="submit" class="btn btn-sm btn-info mt-3 update-comment">Відправити</button>
</form>
