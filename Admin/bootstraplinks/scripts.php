<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>

    function alerting(status, mess, position = 'body'){
        let statusholder = (status == "success") ? "alert-success" : "alert-danger";
        let elementop = document.createElement('div');

        elementop.innerHTML = `
            <div class="alert alerting ${statusholder} alert-dismissible fade show customized" role="alert">
                <strong me-3>${mess}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        if(position == 'body'){
            document.body.append(elementop);
        }else{
            document.getElementById(position).appendChild(elementop);
        }
        setTimeout(remAlert, 5000);
    }

    function remAlert(){
        document.getElementsByClassName('alerting')[0].remove();
    }
</script>