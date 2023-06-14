<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="libraries/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <script src="libraries/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <title>Document</title>
</head>
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <button class="h-100 me-1 btn btn-danger"></button>
      <strong class="me-auto">Error</strong>
      <small>11 mins ago</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      Usuario no encontrado
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    new bootstrap.Toast(document.querySelector("#liveToast")).show();
  })
</script>
</body>

</html>