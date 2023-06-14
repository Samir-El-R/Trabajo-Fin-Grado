<?php
class ErrorManager
{




  public function __construct()
  {
  }
  public function showNotification($message,$tipo)
  {

    echo '
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header bg-'.$tipo.'">

        <strong class="me-auto ">Error</strong>

        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body text-'.$tipo.'">' .
      $message
      .
      '
      </div>
    </div>
  </div>
  <script>
  document.addEventListener("DOMContentLoaded", () => {
    new bootstrap.Toast(document.querySelector("#liveToast")).show();
  })
</script>
        ';
  }
}
