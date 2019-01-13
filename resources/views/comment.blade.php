<div class="col-12 border-bottom tab-{{ $comment->level }}" data-id="{{ $comment->id }}"
     data-level="{{ $comment->level }}" style="padding-bottom: 15px; margin-bottom: 15px">
    <div class="row justify-content-between align-items-center" style="flex-wrap: nowrap; margin-bottom: 10px">
        <div class="col-auto">
            <h5 style="margin-bottom: 0;">{{ $comment->user->name }}</h5>
        </div>


        <div class="col-auto">
            @can('update-own-comment', $comment)
                <a href="javascript:void(0)" class="btn-link btn-lg p-0 edit-comment">
                    <i class="fas fa-edit"></i>
                </a>
            @endcan

            @can('delete-own-comment', $comment)
                <a href="javascript:void(0)" class="btn-link btn-lg p-0 ml-3 delete-comment">
                    <i class="fas fa-trash-alt"></i>
                </a>
            @endcan
        </div>
    </div>
    <span>
    {{ $comment->text }}
    </span>
    <div class="row justify-content-between align-items-center" style="margin-top: 10px">
        <div class="col-auto">
            <div class="row">
                @can('rate-comment', $comment)
                    <div class="col-auto">
                        <div class="btn-group" role="group" aria-label="Basic example">

                            <button type="button" class="btn btn-outline-success rating-comment thumb-up" data-toggle="button" aria-pressed="false">
                                <i class="fas fa-thumbs-up"></i>
                            </button>

                            <button type="button" class="btn btn-outline-danger rating-comment thumb-down" style>
                                <i class="fas fa-thumbs-down"></i>
                            </button>

                        </div>
                    </div>
                @endcan

                <div class="col-auto border border-primary d-flex align-items-center rating-count" style="height: 37px;border-radius: 0.25rem;">
                    {{ $comment->ratings->sum('rating') }}
                </div>
            </div>
        </div>

        @can('create-comment')
            <div class="col-auto">
                <a href="javascript:void(0)" class="btn-link btn-lg p-0 answer-comment">Відповісти</a>
            </div>
        @endcan
    </div>
</div>
