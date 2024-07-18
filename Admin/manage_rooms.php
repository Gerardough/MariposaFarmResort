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
          <h2 class="mb-4">Manage Rooms</h2>

          <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
              <div class="text-end mb-4">
                <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#addRoom">
                <i class="bi bi-plus-lg"></i> Add a Room
                </button>
              </div>


              <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                <table class="table table-hover border">
                  <thead>
                    <tr class="bg-dark text-light">
                      <th scope="col">Room ID</th>
                      <th scope="col">Room Name</th>
                      <th scope="col">Room Type</th>
                      <th scope="col">Capacity</th>
                      <th scope="col">Status</th>
                      <th scope="col">Modification</th>
                    </tr>
                  </thead>

                  <tbody id="room-records">

                  </tbody>
                </table>
              </div>
            </div>
            </div>
          </div>

              <div class="modal fade" id="addRoom" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <!-- Insertion of room modal -->
                  <form id="add_room_form" autocomplete="off">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title">Room Creation</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                        <div class="mb-3">
                          <label class="form-label fw-bold">Room Name</label>
                          <input type="text" name="rmname" class="form-control shadown-none"  required>
                        </div>

                        <div class="d-flex justify-content-between">
                          <div class="col-md-5 mb-3">
                            <label class="form-label fw-bold">Max Adult Capacity</label>
                            <input type="number" name="adult" min="1" max="5" value="1" class="form-control shadown-none" required>
                          </div>
                          <div class="col-md-5 mb-3">
                            <label class="form-label fw-bold">Max Children Capacity</label>
                            <input type="number" name="child" min="1" max="5" value="1" class="form-control shadown-none" required>
                          </div>
                        </div>

                          <div class="mb-3">
                            <label class="form-label">Room Type</label>
                            <select name="rmtype" class="w-100" id="" style="cursor: pointer;">
                            <!-- Selecting room type from roomtype table -->
                            <?php 
                              $assql = "SELECT room_type FROM roomtype";
                              $asrslt = mysqli_query($ascon, $assql);

                              while($asrow = mysqli_fetch_assoc($asrslt)){
                                echo "<option>" . $asrow['room_type'] . "</option>";
                              }
                            ?>

                            </select>
                          </div>
                          <div class="col-12 mb-3">
                              <label class="form-label fw-bold">Features</label>
                              <div class="row">
                                <?php
                                  $assql = "SELECT * FROM features ORDER BY f_id";
                                  $asrslt = mysqli_query($ascon, $assql);
                                  while($asrow = mysqli_fetch_assoc($asrslt)){
                                    echo"
                                      <div class='col-md-3 mb-1'>
                                        <label>
                                          <input type='checkbox' name='features' value='$asrow[f_id]' class='form-check-input shadow-none'>
                                          $asrow[feature]
                                        </label>
                                      </div>
                                    ";
                                  }
                                ?>
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="createroom" class="btn btn-success">Confirm creation of room</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>


              <div class="modal fade" id="editRoom" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <!-- Updating room modal -->
                  <form id="edit_room_form" autocomplete="off">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title">Edit Room Information</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                        <div class="mb-3">
                          <label class="form-label fw-bold">Room Name</label>
                          <input type="text" name="rmname" class="form-control shadown-none" required>
                        </div>

                        <div class="d-flex justify-content-between">
                          <div class="col-md-5 mb-3">
                            <label class="form-label fw-bold">Max Adult Capacity</label>
                            <input type="number" name="adult" min="1" max="5" value="1" class="form-control shadown-none" required>
                          </div>
                          <div class="col-md-5 mb-3">
                            <label class="form-label fw-bold">Max Children Capacity</label>
                            <input type="number" name="child" min="1" max="5" value="1" class="form-control shadown-none" required>
                          </div>
                        </div>

                          <div class="mb-3">
                            <label class="form-label">Room Type</label>
                            <select name="rmtype" class="w-100" id="" style="cursor: pointer;">
                            <!-- Selecting room type from roomtype table -->
                            <?php 
                              $assql = "SELECT room_type FROM roomtype";
                              $asrslt = mysqli_query($ascon, $assql);

                              while($asrow = mysqli_fetch_assoc($asrslt)){
                                echo "<option>" . $asrow['room_type'] . "</option>";
                              }
                            ?>

                            </select>
                          </div>
                          <div class="col-12 mb-3">
                              <label class="form-label fw-bold">Features</label>
                              <div class="row">
                                <?php
                                  $assql = "SELECT * FROM features ORDER BY f_id";
                                  $asrslt = mysqli_query($ascon, $assql);
                                  while($asrow = mysqli_fetch_assoc($asrslt)){
                                    echo"
                                      <div class='col-md-3 mb-1'>
                                        <label>
                                          <input type='checkbox' name='features' value='$asrow[f_id]' class='form-check-input shadow-none'>
                                          $asrow[feature]
                                        </label>
                                      </div>
                                    ";
                                  }
                                ?>
                              </div>
                          </div>
                          <input type="hidden" name="rm_id">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="createroom" class="btn btn-success">Confirm modification of room</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>


              
              <div class="modal fade" id="imageRoom" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5">Room Image</h1>
                      <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div id="image-alert"></div>
                      <div class="border-bottom border-3 pb-3 mb-3">
                        <!-- Room Images -->
                        <form id = "room_image">
                            <label class="form-label fw-bold ">Add room image</label>
                            <input type="file" name="image" accept = ".jpg, .png, webp, .jpeg" class="form-control shadow-none mb-3" required>
                            <button class="btn custom-bg btn-dark text-white shadow-none">Add</button>
                            <input type="hidden" name="rm_id">
                        </form>
                      </div>
                      <div class="table-responsive-lg" style="height: 350px; overflow-y: scroll;">
                          <table class="table table-hover border text-center">
                            <thead>
                              <tr class="bg-dark text-light sticky-top">
                                  <th scope="col" width="60%">Image</th>
                                  <th scope="col">Delete</th>
                              </tr>
                            </thead>

                            <tbody id="room-image-data">

                            </tbody>
                          </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

                </div>
              </div>
              
              </div>
              </div>
            </div>
      </div>
    </div>
    
    <?php 
      require("bootstraplinks/scripts.php");
    ?>

    <script src="scripts/room.js"></script>
  </body>
</html>

