    //Click handler for modal save button
    function modalSave(){
        var myModal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
        myModal.hide();
        let modalText = document.getElementById("modalText");
        let currentID = document.getElementById("currentID");
        let listItem = document.getElementById(currentID.value);
        listItem.innerText = modalText.value;
    
        //Updates Database - API
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

    //Click handler for modal delete button
    function modalDelete(){
        var myModal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
        myModal.hide();
        let currentID = document.getElementById("currentID");
        let listItem = document.getElementById(currentID.value);
        let ul = document.getElementById('shoppingList');
        ul.removeChild(listItem);

        //Updates Database - API
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