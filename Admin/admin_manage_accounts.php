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
    <title>Mariposa Farm Resort - Main Admin - Manage Accounts</title>
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
          <h2 class="mb-4">User Accounts</h2>

              <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                <table class="table table-hover border">
                  <thead>
                    <tr class="bg-dark text-light">
                      <th scope="col">User ID</th>
                      <th scope="col">First Name</th>
                      <th scope="col">Last Name</th>
                      <th scope="col">Address</th>
                      <th scope="col">Birthdate</th>
                      <th scope="col">Age</th>
                      <th scope="col">Contact</th>
                      <th scope="col">Gender</th>
                      <th scope="col">Email</th>
                    </tr>
                  </thead>

                  <tbody id="room-records">

                  </tbody>
                </table>
              </div>
            </div>
            </div>
          </div>

      </div>
    </div>

    <script>

      function retrieve_accs(){

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/manage_rooms.php", true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      xhr.onload = function(){
        document.getElementById('room-records').innerHTML = this.responseText;
      }

      xhr.send('retrieve_accs');
      }

      window.onload = function(){
      retrieve_accs();
      }
    </script>

<?php require("bootstraplinks/scripts.php"); ?>
  </body>
</html>