<td class="text-center">
    <div class="btn-group">
        <a href="{{$comment->measurement->getFrontUrl()}}" target="_blank" class="text-cyan">
            {{\Str::limit($comment->measurement->title, 20, ' ...')}}
        </a>
    </div>
</td>