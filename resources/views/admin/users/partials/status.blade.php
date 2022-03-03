@if($user->isEnabled())
<span class="text-success">@lang('Aktiviraj')</span>
@endif
@if($user->isDisabled())
<span class="text-danger">@lang('Deaktiviraj')</span>
@endif