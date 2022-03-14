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

<script>
    function modalSave(){
        var myModal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
        myModal.hide();
        let modalText = document.getElementById("modalText");
        let currentID = document.getElementById("currentID");
        let listItem = document.getElementById(currentID.value);
        listItem.innerText = modalText.value;
    
        let data = {
            action: 'update',
            itemID: parseInt(currentID.value.replace(/\D/g,'')),
            text: modalText.value
        };

        fetch('api.php', {
            method: 'POST',
            body: JSON.stringify(data),
            headers: new Headers({
                'Content-Type': 'application/json; charset=UTF-8'
            })
         })
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            if (data.Status === 'Success') {
            }
        })
        .catch(function(error) {
            console.log(error);
        });
    }

    function modalDelete(){
        var myModal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
        myModal.hide();
        let currentID = document.getElementById("currentID");
        let listItem = document.getElementById(currentID.value);
        let ul = document.getElementById('shoppingList');
        ul.removeChild(listItem);

        let data = {
            action: 'delete',
            itemID: parseInt(currentID.value.replace(/\D/g,''))
        };

        fetch('api.php', {
            method: 'POST',
            body: JSON.stringify(data),
            headers: new Headers({
                'Content-Type': 'application/json; charset=UTF-8'
            })
         })
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            if (data.Status === 'Success') {
            }
        })
        .catch(function(error) {
            console.log(error);
        });

    }

    function editLI(targetID) {
        console.log(targetID + " was clicked");
        var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
            keyboard: false
        })
        let ul = document.getElementById(targetID);
        let modalText = document.getElementById("modalText");
        let currentID = document.getElementById("currentID");
        modalText.value = ul.innerText;
        currentID.value = targetID;
        myModal.show();
    }

    document.querySelectorAll('.list-group-item').forEach(item => {
        item.addEventListener('click', event => { editLI(event.target.id) });
    })

    var button = document.getElementById('add');
    button.addEventListener('click', function(e){
        let newItem = prompt('New shopping list item:');

        let data = {
            action: 'add',
            newItem: newItem
        };

        fetch('api.php', {
            method: 'POST',
            body: JSON.stringify(data),
            headers: new Headers({
                'Content-Type': 'application/json; charset=UTF-8'
            })
         })
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            if (data.Status === 'Success') {
                let ul = document.getElementById('shoppingList');
                let li = document.createElement("li");
                li.addEventListener('click', event => { editLI(event.target.id) });
                li.appendChild(document.createTextNode(newItem)); 
                li.id = "list_id_" + data.itemID;
                li.classList = "list-group-item";
                ul.appendChild(li);
            }
        })
        .catch(function(error) {
            console.log(error);
        });
    });
    </script>

<?php 
include 'footer.inc.php';
?>
