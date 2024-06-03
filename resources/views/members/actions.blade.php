<div class="d-flex flex-nowrap" style="gap: 0.75rem">
  <a href="{{ route('members.edit', $member->id) }}" data-toggle="tooltip" data-placement="top" title="Edit">
    <i class="fa fa-pencil color-muted"></i>
  </a>
  <a href="{{ route('members.show', $member->id) }}" data-toggle="tooltip" data-placement="top" title="View">
    <i class="fa fa-eye color-muted"></i>
  </a>
  @if($member->email_verified_at)
  <a href="javascript:void(0)" onclick="$('#resend-verification-{{ $member->id }}').submit()" data-toggle="tooltip" data-placement="top" title="{{ __('Unverify & Resend') }}">
    <i class="fa fa-refresh color-muted"></i>
  </a>
  <form action="{{ route('members.resend-verification', $member) }}" class="d-none" method="POST" id="resend-verification-{{ $member->id }}">
    @csrf
    @method('PATCH')
  </form>
  @else
  <a href="javascript:void(0)" onclick="$('#verify-member-{{ $member->id }}').submit()" data-toggle="tooltip" data-placement="top" title="{{ __('Verify') }}">
    <i class="fa fa-check color-muted"></i>
  </a>
  <form action="{{ route('members.verify', $member) }}" class="d-none" method="POST" id="verify-member-{{ $member->id }}">
    @csrf
    @method('PATCH')
  </form>
  @endif
  <!-- Change Password -->
  <a href="{{ route('members.password.edit', $member) }}" data-toggle="tooltip" data-placement="top" title="{{ __('Change Password') }}">
    <span data-toggle="modal" data-target="#change-password-{{ $member->id }}-modal">
      <i class="fa fa-key color-muted"></i>
    </span>
  </a>
  <!-- Delete Account -->
  <a href="javascript:void(0)" onclick="$('#delete-member-{{ $member->id }}').submit()" data-toggle="tooltip" data-placement="top" title="{{ __('Delete') }}">
    <i class="fa fa-trash color-muted"></i>
  </a>
  <form action="{{ route('members.destroy', $member) }}" class="d-none" method="POST" id="delete-member-{{ $member->id }}">
    @csrf
    @method('DELETE')
  </form>
</div>