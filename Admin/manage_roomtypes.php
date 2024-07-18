<?php 
  require("essentials/func.php");
  include "db_config/DBCall.php";
  adminlogin("Main Admin");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mariposa Farm Resort - Main Admin - Manage Rooms</title>
    <?php require("bootstraplinks/linking.php"); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .customized{
            position: fixed;
            top: 120px;
            right: 25px;
        }

        #dashboard-menu{
            position: fixed;
            height: 100%;
        }

        @media screen and (max-width: 992px){
            #dashboard-menu{
                position: fixed;
                height: auto;
                width: 100%;
            }

            .customized{
                top: 180px;
                left: 25px;
            }

            #main-section{
                margin-top: 80px;
            }
        }
    </style>
  </head>
  <body>
    <?php require("essentials/maheader.php"); ?>   

    <div class="container-fluid" id="main-section">
      <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
          <h2 class="mb-4">Manage Room Types</h2>
          <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
              <div class="text-end mb-4">
                <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#addType">
                <i class="bi bi-plus-lg"></i> Add a room type
                </button>
              </div>


              <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                <table class="table table-hover border">
                  <thead>
                    <tr class="bg-dark text-light">
                      <th scope="col">Room Type ID</th>
                      <th scope="col">Room Type</th>
                      <th scope="col">Price</th>
                      <th scope="col">Modification</th>
                    </tr>
                  </thead>

                  <tbody id="type-records">

                  </tbody>
                </table>
              </div>
            </div>
            </div>
          </div>

              <div class="modal fade" id="addType" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <!-- Insertion of room type -->
                  <form id="add_room_type" autocomplete="off">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title">Room Type Creation</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">

                        <div class="d-flex justify-content-between">
                          <div class="col-md-5 mb-3">
                          <label class="form-label fw-bold">Room Type</label>
                          <input type="text" name="rtype" class="form-control shadown-none" required>
                          </div>
                          <div class="col-md-5 mb-3">
                            <label class="form-label fw-bold">Price</label>
                            <input type="number" id="price" name="rprice" class="form-control shadown-none" min="0" step="0.01" pattern="^-?\d+(\.\d+)?$" required>
                          </div>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="desc" rows="4" class= "form-control shadow-none" style = "resize: none;" required></textarea>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="createroom" class="btn btn-success">Confirm creation of room type</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
      </div>


            <div class="modal fade" id="editType" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <!-- Updating of room type -->
                  <form id="edit_room_type" autocomplete="off">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title">Updating Room Type</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">

                        <div class="d-flex justify-content-between">
                          <div class="col-md-5 mb-3">
                          <label class="form-label fw-bold">Room Type</label>
                          <input type="text" name="rtype" class="form-control shadown-none" required>
                          </div>
                          <div class="col-md-5 mb-3">
                            <label class="form-label fw-bold">Price</label>
                            <input type="number" id="price" name="rprice" class="form-control shadown-none" min="0" step="0.01" pattern="^-?\d+(\.\d+)?$" required>
                          </div>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="desc" rows="4" class= "form-control shadow-none" style = "resize: none;" required></textarea>
                        </div>
                        <input type="hidden" name="rt_id">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="createroom" class="btn btn-success">Confirm modification of room type</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
    </div>


    <div class="container-fluid" id="main-section">
      <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
          <h2 class="mb-4">Manage Room Features</h2>
          <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
              <div class="text-end mb-4">
                <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#addFeature">
                <i class="bi bi-plus-lg"></i> Add a room feature
                </button>
              </div>


              <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                <table class="table table-hover border">
                  <thead>
                    <tr class="bg-dark text-light">
                      <th scope="col">Room Feature ID</th>
                      <th scope="col">Feature</th>
                    </tr>
                  </thead>

                  <tbody id="feat-records">

                  </tbody>
                </table>
              </div>
            </div>
            </div>
          </div>

              <div class="modal fade" id="addFeature" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <!-- Insertion of room type -->
                  <form id="add_room_feature" autocomplete="off">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title">Room Feature Creation</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">

                        <div class="d-flex">
                          <div class="col-md-12 mb-3">
                          <label class="form-label fw-bold">Feature</label>
                          <input type="text" name="feature" class="form-control shadown-none" required>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="createfeature" class="btn btn-success">Confirm creation of room feature</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>



              <div class="modal fade" id="editFeat" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <!-- Updating of room type -->
                  <form id="edit_room_feat" autocomplete="off">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title">Updating Room Feature</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">

                        <div class="d-flex justify-content-between">
                          <div class="col-md-5 mb-3">
                          <label class="form-label fw-bold">Room Feature</label>
                          <input type="text" name="feat" class="form-control shadown-none" required>
                          </div>
                        </div>
                        <input type="hidden" name="f_id">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="createfeat" class="btn btn-success">Confirm modification of room feature</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
      </div>

        
        <?php 
            require("bootstraplinks/scripts.php");
        ?>

    <script>
        // Formatting the price textfield
        const doubleInput = document.getElementById('price');

        doubleInput.addEventListener('input', function (event) {
            let value = event.target.value;

            if (!/^-?\d*\.?\d*$/.test(value)) {
                event.target.value = value.slice(0, -1);
            }
        });

        doubleInput.addEventListener('blur', function (event) {
            let value = parseFloat(event.target.value);
            if (!isNaN(value)) {
                event.target.value = value.toFixed(2);
            }
        });

        let add_type = document.getElementById('add_room_type');
        add_type.addEventListener('submit', function(e){
          e.preventDefault();
          add_the_type();
        });


        // Inserting records of room types
        function add_the_type(){
          let info = new FormData();
          info.append('add_type', '');
          info.append('type', add_type['rtype'].value);
          info.append('price', add_type['price'].value);
          info.append('desc', add_type['desc'].value);

          let xhr = new XMLHttpRequest();
          xhr.open("POST", "ajax/manage_roomtypes.php", true);

          xhr.onload = function(){
            var myModal = document.getElementById('addType');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();
            console.log('Response:', this.responseText);

            if(this.responseText == 1){
              alerting('success', 'New room type added!');
              add_type.reset();
              retrieve_types();
            }else if(this.response == 2){
              alerting('failed', 'Duplication of room types is not allowed! Try again!')
            }else{
              alerting('failed', 'Cannot process the request... try again');
            }
          }
          xhr.send(info);
        }

        let add_feat = document.getElementById('add_room_feature');
        add_feat.addEventListener('submit', function(e){
          e.preventDefault();
          add_the_feat();
        });

        // Inserting records of room types
        function add_the_feat(){
          let info = new FormData();
          info.append('add_the_feat', '');
          info.append('feat', add_feat['feature'].value);

          let xhr = new XMLHttpRequest();
          xhr.open("POST", "ajax/manage_roomtypes.php", true);

          xhr.onload = function(){
            var myModal = document.getElementById('addFeature');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();
            console.log('Response:', this.responseText);

            if(this.responseText == 1){
              alerting('success', 'New room feature added!');
              add_feat.reset();
              retrieve_features();
            }else if(this.response == 2){
              alerting('failed', 'Duplication of room features is not allowed! Try again!')
            }else{
              alerting('failed', 'Cannot process the request... try again');
            }
          }
          xhr.send(info);
        }

        function retrieve_types(){

          let xhr = new XMLHttpRequest();
          xhr.open("POST", "ajax/manage_roomtypes.php", true);
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

          xhr.onload = function(){
            document.getElementById('type-records').innerHTML = this.responseText;
          }

          xhr.send('retrieve_types');
        }

        window.onload = function(){
          retrieve_types();
          retrieve_features();
        }


        function retrieve_features(){

          let xhr = new XMLHttpRequest();
          xhr.open("POST", "ajax/manage_roomtypes.php", true);
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

          xhr.onload = function(){
            document.getElementById('feat-records').innerHTML = this.responseText;
          }

          xhr.send('retrieve_features');
          }


        let edit_type = document.getElementById('edit_room_type');

        function edit_rdetail(rt_id){
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/manage_roomtypes.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        xhr.onload = function(){
            let info = JSON.parse(this.responseText);
            edit_type.elements['rt_id'].value = info.rm_info.rt_id;
            edit_type.elements['rtype'].value = info.rm_info.room_type;
            edit_type.elements['price'].value = info.rm_info.price;
            edit_type.elements['desc'].value = info.rm_info.room_desc;
        }
        xhr.send('get_room= ' + rt_id);
        }

        edit_type.addEventListener('submit', function(e){
          e.preventDefault();
          submit_modified_type();
        });


        function submit_modified_type(){
          let info = new FormData();
          info.append('edit_type', '');
          info.append('rt_id', edit_type.elements['rt_id'].value);
          info.append('rtype', edit_type.elements['rtype'].value);
          info.append('price', edit_type.elements['price'].value);
          info.append('desc', edit_type.elements['desc'].value);

          let xhr = new XMLHttpRequest();
          xhr.open("POST", "ajax/manage_roomtypes.php", true);

          xhr.onload = function(){
            var myModal = document.getElementById('editType');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();
            console.log('Response:', this.responseText);

            if(this.responseText == 1){
              alerting('success', 'Room type update successful!');
              edit_type.reset();
              retrieve_types();
            }else if(this.response == 2){
              alerting('failed', 'Duplication of rooms is not allowed for the specified room type! Try again!')
            }else{
              alerting('failed', 'Cannot process the request... try again');
            }
          }
          xhr.send(info);
        }




        function remove_type(rt_id){
          if (confirm("Are you sure with the room removal?")){
            let info = new FormData();
            info.append('rt_id', rt_id);
            info.append('remove_rt', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/manage_roomtypes.php", true);
            xhr.onload = function(){
              if(this.responseText == 1){
                alerting('success', 'Record of room type successfully removed!');
                retrieve_types();
              }else{
                alerting('failed', 'Error in removing the specified room type, try again.')
              }
            }
            xhr.send(info);
          }
        }
    </script>


</body>
</html>