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

<script>
    function editLI(targetID) {
        console.log(targetID + " was clicked");
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
