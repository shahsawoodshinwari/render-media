<script>
  document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
      const successMessage = "{{ session()->get('success') }}";
      if (successMessage) {
        swal({
          title: "{{ __('Success') }}",
          text: successMessage,
          type: 'success'
        });
      }

      const errorMessage = "{{ session()->get('error') }}";
      if (errorMessage) {
        swal({
          title: "{{ __('Error') }}",
          text: errorMessage,
          type: 'error'
        });
      }
    }, 2000);
  });
</script>