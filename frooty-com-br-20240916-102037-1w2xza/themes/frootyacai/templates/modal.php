<style>
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 99999; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 0 20px 20px;
  width: 100%; /* Could be more or less, depending on screen size */
  max-width: 800px;
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  text-align: right;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

.visible {
    display: block;
}

</style>

<div id="modalFrootyTwist" class="modal">

<div class="modal-content">
    <span class="close">&times;</span>
    <img src="<?= get_template_directory_uri(); ?>/assets/img/frooty-twist-modal.png" alt="">
  </div>

</div>

<script>
    // let modalExit = false;
    // let close = document.querySelector('.close');

    // document.addEventListener('mouseleave', (e) => {
    //     //Check mouse is above the viewport
    //     if (e.clientY < 0 && modalExit == false) {
    //         $('#modalFrootyTwist').toggleClass('visible');
    //         modalExit = true;
    //     }
    // });
    
    // close.addEventListener('click', () => {
    //     $('#modalFrootyTwist').toggleClass('visible');
    // })
</script>