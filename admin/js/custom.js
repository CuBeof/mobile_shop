$(document).ready(function(){
    $('#confirm-delete-modal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var title = button.data('title') // Extract info from data-* attributes
      var pri_id = button.data('id')
      
      var modal = $(this)
      modal.find('#modal-product-name').text(title)
      modal.find('#delete-link').attr("href","del_product.php?prd_id=" + pri_id)
    })
});