<?php 
  include('./services/api.php'); 

  $query = "SELECT * FROM courses";
  $stmt = $pdo->query($query);
  $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<?php include('./includes/head.php'); ?>


<body>


  <?php include('./includes/menu.php'); ?>

  <div class="section events" id="events">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="section-heading">
            <h2>Courses</h2>
          </div>
        </div>

        <?php foreach ($courses as $index => $course) : ?>

        <div class="col-lg-12 col-md-6">
          <div class="item">
            <div class="row">
              <div class="col-lg-3">
                <div class="image">
                  <img src="assets/images/event-01.jpg" alt="">
                </div>
              </div>
              <div class="col-lg-9">
                <ul>
                  <li>
                    <span class="category"><?php echo $course['course']; ?></span> <!-- Adicionado o campo 'category' do banco de dados -->
                    <h4><?php echo $course['title']; ?></h4> <!-- Adicionado o campo 'title' do banco de dados -->
                  </li>
                  <li>
                    <span>Duration:</span>
                    <h6><?php echo $course['duration']; ?> h</h6> <!-- Adicionado o campo 'duration' do banco de dados -->
                  </li>
                </ul>
                <a href="#"><i class="fa fa-angle-right"></i></a>
              </div>
            </div>
          </div>
        </div>
          
        <?php endforeach; ?>
       
      </div>
    </div>
  </div>

  <?php include('./includes/footer.php'); ?>
</body>
</html>
