let add_room = document.getElementById('add_room_form');
        add_room.addEventListener('submit', function(e){
          e.preventDefault();
          add_the_room();
        });

        function add_the_room(){
          let info = new FormData();
          info.append('add_room', '');
          info.append('rmname', add_room['rmname'].value);
          info.append('adult', add_room['adult'].value);
          info.append('child', add_room['child'].value);
          info.append('rmtype', add_room['rmtype'].value);

          let features = [];

          add_room.elements['features'].forEach(elem =>{
            if(elem.checked){
              features.push(elem.value);
            }
          });
          info.append('features', JSON.stringify(features));

          let xhr = new XMLHttpRequest();
          xhr.open("POST", "ajax/manage_rooms.php", true);

          xhr.onload = function(){
            var myModal = document.getElementById('addRoom');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();
            console.log('Response:', this.responseText);

            if(this.responseText == 1){
              alerting('success', 'New room added!');
              add_room.reset();
              retrieve_rooms();
            }else if(this.response == 2){
              alerting('failed', 'Duplication of rooms is not allowed for the specified room type! Try again!')
            }else{
              alerting('failed', 'Cannot process the request... try again');
            }
          }
          xhr.send(info);
        }

        function retrieve_rooms(){

          let xhr = new XMLHttpRequest();
          xhr.open("POST", "ajax/manage_rooms.php", true);
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

          xhr.onload = function(){
            document.getElementById('room-records').innerHTML = this.responseText;
          }

          xhr.send('retrieve_rooms');
        }

        window.onload = function(){
          retrieve_rooms();
        }

        function changestatus(id, val){
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/manage_rooms.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){
              if(this.responseText==1){
                alerting('success', 'Status successfully changed!');
                retrieve_rooms();
              }else{
                alerting('failed', 'Error in changing the status... try again');
              }
            }

            xhr.send('changestatus=' + id + '&value=' + val);
        }

        let edit_room = document.getElementById('edit_room_form');

        function edit_rdetail(rm_id){
          let xhr = new XMLHttpRequest();
          xhr.open("POST", "ajax/manage_rooms.php", true);
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
          xhr.onload = function(){
            let info = JSON.parse(this.responseText);
            edit_room.elements['rm_id'].value = info.rm_info.rm_id;
            edit_room.elements['rmname'].value = info.rm_info.room_name;
            edit_room.elements['adult'].value = info.rm_info.adult_capacity;
            edit_room.elements['child'].value = info.rm_info.child_capacity;
            edit_room.elements['rmtype'].value = info.rm_info.room_type;

            edit_room.elements['features'].forEach(elem=>{
              if(info.features.includes(Number(elem.value))){
                elem.checked = true;
              }else{
                elem.checked = false;
              }
            })
        }
          xhr.send('get_room= ' + rm_id);
        }

        edit_room.addEventListener('submit', function(e){
          e.preventDefault();
          submit_modified_room();
        });


        function submit_modified_room(){
          let info = new FormData();
          info.append('edit_room', '');
          info.append('rm_id', edit_room.elements['rm_id'].value);
          info.append('rmname', edit_room.elements['rmname'].value);
          info.append('adult', edit_room.elements['adult'].value);
          info.append('child', edit_room.elements['child'].value);
          info.append('rmtype', edit_room.elements['rmtype'].value);

          let features = [];

          edit_room.elements['features'].forEach(elem =>{
            if(elem.checked){
              features.push(elem.value);
            }
          });
          info.append('features', JSON.stringify(features));

          let xhr = new XMLHttpRequest();
          xhr.open("POST", "ajax/manage_rooms.php", true);

          xhr.onload = function(){
            var myModal = document.getElementById('editRoom');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();
            console.log('Response:', this.responseText);

            if(this.responseText == 1){
              alerting('success', 'Room update successful!');
              edit_room.reset();
              retrieve_rooms();
            }else if(this.response == 2){
              alerting('failed', 'Duplication of rooms is not allowed for the specified room type! Try again!')
            }else{
              alerting('failed', 'Cannot process the request... try again');
            }
          }
          xhr.send(info);
        }

        let addImage = document.getElementById('room_image');
        addImage.addEventListener('submit', function(e){
          e.preventDefault();
          add_Image();
        });

        function add_Image(){
          let info = new FormData();
          info.append('image', addImage.elements['image'].files[0]);
          info.append('rm_id', addImage.elements['rm_id'].value);
          info.append('room_name', document.querySelector("#imageRoom .modal-title").innerText )
          info.append('add_image', '');

          let xhr = new XMLHttpRequest();
          xhr.open("POST", "ajax/manage_rooms.php", true);

          xhr.onload = function(){
            
            if(this.responseText == 'inv_img'){
              alerting('failed', 'Only JPG, WEBP, or PNG images are allowed!');
            }else if(this.responseText == 'inv_size'){
              alerting('failed', 'Images must be less than 2MB');
            }else if(this.responseText == 'upd_failed'){
              alerting('failed', 'Unsuccessful upload, try again!');
            }else{
              alerting('success', 'Successful addition of room image', 'image-alert');
              room_images(addImage.elements['rm_id'].value, document.querySelector("#imageRoom .modal-title").innerText )
              addImage.reset();
            }
          }
          xhr.send(info);
        }


        function room_images(rm_id, room_name){
          console.log("rm_id:", rm_id);
          console.log("room_name:", room_name);
          document.querySelector("#imageRoom .modal-title").innerText = room_name;
          addImage.elements['rm_id'].value = rm_id;
          addImage.elements['image'].value = '';

          let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/manage_rooms.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){
             document.getElementById('room-image-data').innerHTML = this.responseText;
            }

            xhr.send('get_room_images=' + rm_id);
        }


        function remove_image(img_id, room_id){

          let info = new FormData();
          info.append('image_id', img_id);
          info.append('room_id', room_id);
          info.append('rem_image', '' );

          let xhr = new XMLHttpRequest();
          xhr.open("POST", "ajax/manage_rooms.php", true);

          xhr.onload = function(){
            
            if(this.responseText == 1){
              alerting('success', 'Successful removal of image!', 'image-alert');
              room_images(room_id, document.querySelector("#imageRoom .modal-title").innerText );
              
            }else{
              alerting('failed', 'Failure in removal the room image, try again.');
            }
          }
          xhr.send(info);
        }
        
        function remove_room(room_id){
          if (confirm("Are you sure with the room removal?")){
            let info = new FormData();
            info.append('room_id', room_id);
            info.append('remove_room', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/manage_rooms.php", true);
            xhr.onload = function(){
              if(this.responseText == 1){
                alerting('success', 'Record of room successfully removed!');
                retrieve_rooms();
              }else{
                alerting('failed', 'Error in removing the specified room, try again.')
              }
            }
            xhr.send(info);
          }
        }