<?php 
  require("essentials/func.php");
  include "db_config/DBCall.php";
  adminlogin("Reservations Manager");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mariposa Farm Resort - Reservations Manager - Manage Bookings</title>
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
    <?php require("essentials/rmheader.php"); ?>   

    <div class="container-fluid" id="main-section">
      <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
          <h2 class="mb-4">Manage Billings</h2>

              <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                <table class="table table-hover border">
                  <thead>
                    <tr class="bg-dark text-light">
                      <th scope="col">Billing ID</th>
                      <th scope="col">Initial Deposit</th>
                      <th scope="col">Total Price</th>
                      <th scope="col">Payment Method</th>
                      <th scope="col">Date of Reservation</th>
                      <th scope="col">Reservation Expiration Date</th>
                      <th scope="col">Room Name</th>
                      <th scope="col">Room Type</th>
                      <th scope="col">Client Email</th>
                      <th scope="col">Check In Date</th>
                      <th scope="col">Check Out Date</th>
                      <th scope="col">Bill Status</th>
                      <th scope="col">Confirmation</th>
                      <th scope="col">Cancellation</th>
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

      function retrieve_billings(){

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/manage_billings.php", true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      xhr.onload = function(){
        document.getElementById('room-records').innerHTML = this.responseText;
      }

      xhr.send('retrieve_billings');
      }

      window.onload = function(){
      retrieve_billings();
      }


      function book_now(bill_id){

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/manage_billings.php", true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      xhr.onload = function(){
              if(this.responseText==1){
                alerting('success', 'Successful Booking!');
                retrieve_billings();
              }else{
                alerting('failed', 'Error in booking... try again');
              }
            }

      xhr.send('book_now=' + bill_id);
      }


      function cancel_now(bill_id) {
      if (confirm("Are you sure you want to cancel this booking?")) {
          let xhr = new XMLHttpRequest();
          xhr.open("POST", "ajax/manage_billings.php", true);
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

          xhr.onload = function() {
              if (this.responseText == 1) {
                  alerting('success', 'Cancellation successful!');
                  retrieve_billings();
              } else {
                  alerting('failed', 'Error in cancelling booking... try again');
              }
          }

          xhr.send('cancel_now=' + bill_id);
        }
      } 
    </script>

    <?php require("bootstraplinks/scripts.php"); ?>

    
  </body>
</html>