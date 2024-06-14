<div class="d-flex flex-nowrap" style="gap: 0.75rem">
  <a href="{{ route('cms.faqs.edit', $faq->id) }}" data-toggle="tooltip" data-placement="top" title="Edit">
    <i class="fa fa-pencil color-muted"></i>
  </a>
  <!-- Delete FAQ -->
  <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="{{ __('Delete') }}">
    <span data-toggle="modal" data-target="#delete-faq-{{ $faq->id }}-modal">
      <i class="fa fa-trash color-muted"></i>
    </span>
  </a>
  <div class="modal fade" id="delete-faq-{{ $faq->id }}-modal" tabindex="-1" aria-labelledby="delete-faq-{{ $faq->id }}-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="{{ route('cms.faqs.destroy', $faq->id) }}" class="modal-body" method="POST" id="delete-faq-{{ $faq->id }}-form">
          @csrf
          @method('DELETE')
          <p>
            {{ __('Are you sure you want to delete? This action cannot be undone.') }}
          </p>
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
            {{ __('No') }}
          </button>
          <button type="submit" form="delete-faq-{{ $faq->id }}-form" class="btn btn-sm btn-primary">
            {{ __('Yes') }}
          </button>
        </form>
      </div>
    </div>
  </div>
</div>