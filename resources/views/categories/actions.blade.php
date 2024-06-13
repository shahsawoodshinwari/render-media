<div class="d-flex flex-nowrap" style="gap: 0.75rem">
  <!-- View Category -->
  <a href="{{ route('categories.sub-categories.index', $category->slug) }}" data-toggle="tooltip" data-placement="top" title="View">
    <i class="fa fa-eye color-muted"></i>
  </a>

  <!-- Edit Category -->
  <a href="{{ route('categories.edit', $category->slug) }}" data-toggle="tooltip" data-placement="top" title="Edit">
    <i class="fa fa-pencil color-muted"></i>
  </a>

  <!-- Delete Category -->
  <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="{{ __('Delete') }}">
    <span data-toggle="modal" data-target="#delete-category-{{ $category->slug }}-modal">
      <i class="fa fa-trash color-muted"></i>
    </span>
  </a>
</div>
<div class="modal fade" id="delete-category-{{ $category->slug }}-modal" tabindex="-1" aria-labelledby="delete-category-{{ $category->slug }}-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="{{ route('categories.destroy', $category) }}" class="modal-body" method="POST" id="delete-category-{{ $category->slug }}-form">
        @csrf
        @method('DELETE')
        <p>
          {{ __('Are you sure you want to delete remove this category? This action cannot be undone.') }}
        </p>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
          {{ __('No') }}
        </button>
        <button type="submit" form="delete-category-{{ $category->slug }}-form" class="btn btn-sm btn-primary">
          {{ __('Yes') }}
        </button>
      </form>
    </div>
  </div>
</div>