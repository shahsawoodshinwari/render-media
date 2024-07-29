<div class="d-flex flex-nowrap" style="gap: 0.75rem">
  <a href="{{ route('freelancers.edit', $freelancer->id) }}" data-toggle="tooltip" data-placement="top" title="Edit">
    <i class="fa fa-pencil color-muted"></i>
  </a>
  <!-- Delete Account -->
  <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="{{ __('Delete') }}">
    <span data-toggle="modal" data-target="#delete-freelancer-{{ $freelancer->id }}-modal">
      <i class="fa fa-trash color-muted"></i>
    </span>
  </a>
  <div class="modal fade" id="delete-freelancer-{{ $freelancer->id }}-modal" tabindex="-1" aria-labelledby="delete-freelancer-{{ $freelancer->id }}-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="{{ route('freelancers.destroy', $freelancer) }}" class="modal-body" method="POST" id="delete-freelancer-{{ $freelancer->id }}-form">
          @csrf
          @method('DELETE')
          <p>
            {{ __('Are you sure you want to delete remove this freelancer? This action cannot be undone.') }}
          </p>
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
            {{ __('No') }}
          </button>
          <button type="submit" form="delete-freelancer-{{ $freelancer->id }}-form" class="btn btn-sm btn-primary">
            {{ __('Yes') }}
          </button>
        </form>
      </div>
    </div>
  </div>
</div>