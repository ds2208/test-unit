@if($comment->index == 1)
<span class="text-success">@lang('Aktivan')</span>
@else
<span class="text-danger">@lang('Neaktivan')</span>
@endif