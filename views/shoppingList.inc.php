<?php 
include 'header.inc.php';
?>
<div class="col-md-10 mx-auto col-lg-5">
    <h1>Shopping List</h1>
    <ul id="shoppingList" class="list-group" style="margin-top:2em;">
    <?php
        if (empty($items)){
            echo '<li id="myList" class="list-group-item">List is empty</li>';
        } else {
            foreach($items as $item){
                echo '<li id="list_id_' . $item['id'] . '" class="list-group-item">' . $item['item'] .'</li>';
            }
        }
        ?>
    </ul>
    <button id="add" type="button" class="btn btn-primary" style="margin-top:2em">Add new item</button>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit List Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <input type="text" class="form-control" id="modalText" placeholder="Item Name">
          <input type="hidden" id="currentID">
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="modalDelete()">Delete</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="modalSave()">Save changes</button>
      </div>
    </div>
  </div>
</div>

<?php 
include 'footer.inc.php';
?>
