<?php
if(session_id() == '') {
    session_start();
  } 
 include 'header.php'; ?>

<section  class="about-section layout_padding">

<div class="unit">
      <h2 id="title">Frequently Asked Questions</h2> <br>
      <?php 
            require('conn.php');
            $sql = "SELECT * FROM faqs";
            $result = $conn->query($sql); 
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) { 
       ?>
      <div class="accordion">
        <div class="accordion-item">
          <button id="accordion-button" aria-expanded="false">
            <span class="accordion-title"><?php echo $row["question"]; ?></span>
            <span class="icon" aria-hidden="true"></span>
          </button>
          <div class="accordion-content">
            <p>
            <?php echo $row["answer"]; ?>
            </p>
          </div>
        </div>
      </div>
      <?php } } ?>
</div>
              </section>

<script>
    const items = document.querySelectorAll('.accordion button');

function toggleAccordion() {
  const itemToggle = this.getAttribute('aria-expanded');

  for (i = 0; i < items.length; i++) {
    items[i].setAttribute('aria-expanded', 'false');
  }

  if (itemToggle == 'false') {
    this.setAttribute('aria-expanded', 'true');
  }
}

items.forEach((item) => item.addEventListener('click', toggleAccordion));

    </script>



<?php include 'footer.php'; ?>
<script src="js/jquery-3.4.1.min.js"></script>
<!-- bootstrap js -->
<script src="js/bootstrap.js"></script>
<!-- custom js -->
<script src="js/custom.js"></script>