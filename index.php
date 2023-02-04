<?php
include 'conecte.php';

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $space = $_POST['space'];
    $date = $_POST['date'];
    $location = $_POST['location'];


    $image = $_POST['image'];
    
    // $image = $_FILES['image']['tmp_name'];
    // $target = "images/".$_FILES['image'];

    $discription = $_POST['discription'];

    $sql = "INSERT INTO `announce` (`title`, `type`,  `price`, `space`, `date`, `location`, `image`, `discription`) VALUES ('$title', '$type',  '$price', '$space', '$date', '$location', '$image', '$discription');";
    $result = mysqli_query($conn, $sql);
     if ($result) {
        // echo "data insert successfully";
     } else {
        die(mysqli_error($conn));
     }

}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestion des annonces d'une agence immobilière</title>
    <!--======================== Link bootsrap ======================================-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <!--======================== link css ======================================-->
    <link rel="stylesheet" href="style.css" />
    <!--======================== link Librarry font Awesom ======================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body>
    <nav class="navbar navbar-light bg-light w-100 position-fixed">
      <div class="container-fluid">
        <img
          src="images/Logo.png"
          alt=""
          width="160"
          height="130"
          class="d-inline-block align-text-top"
        />
        <div>
          <a class="navbar-brand" href="#">Home</a>
          <a class="navbar-brand" href="#">About</a>
          <a class="navbar-brand" href="#">Contact</a>
        </div>
      </div>
    </nav>
    <main class="">
      <section class="section-one">
        <div id="btn-serch" class="w-75">
          <form action="" class="w-100 d-flex justify-content-center">
            <label for="" class="d-flex">
              type: 
               <select class="form-select form-select-sm" aria-label=".form-select-sm example" name= "type">
                <option value="Rent">For Rent</option>
                <option value="Sale">For Sale</option>
              </select>
            </label>
            <label for="" class="d-flex" id="max-price">
              Max Price: 
              <input type="number" min="0">
            </label>
            <label for="" class="d-flex" id="min-Price">
              Min Price: 
              <input type="number" min="0">
            </label>
            <button type="submit" class="btn btn-primary ml-4">Submit</button>
          </form>
        </div>
      
      <!--======================================== MODAL ===========================================-->
        <!-- Modal add -->
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" id="btn-add">Open Modal</button>

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Add Announce</h2>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body d-flex flex-column" id = "add-announce">
                  <form action="index.php" method = "POST">
                      <label for="" class = "w-100">Title
                          <input type="text" name = "title">
                      </label>
                      <label class = "w-100">type:
                          <select id="" name = "type">
                              <option value="Vent">Vent</option> 
                              <option value="Sale">Sale</option> 
                          </select>
                      </label>
                      <label class = "w-100">Date
                          <input type="date" name= "date">
                      </label>
                      <label class = "w-100">Price
                          <input type="number" min="0" name = "price">
                      </label>
                      <label class = "w-100">Space
                          <input type="number" min="0" name = "space">
                      </label>
                      <label class = "w-100" >Location
                          <input type="text" min="0" name="location">
                      </label>
                      <label class = "w-100">
                          Add image
                          <input type="file" name = "image">
                      </label>
                      <label class = "w-100">Discription
                          <input type="" name = "discription">
                      </label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name = "submit">Add Announce</button>
                    </div>
                </form>
            </div>
        </div>  
        <!-- modal Delet -->


    </section>
      <section class="container mt-5">
        <div class="row mb-4 flex-wrap w-100">

          <?php
            $sql = "SELECT * FROM announce ";
            $result = $conn->query($sql);

            $data = $result->fetch_all(MYSQLI_ASSOC);
                    foreach ($data as $key => $value) {
            // delet card function ===================
            // $id = $_GET['id'];
            // $if (isset($_GET['id'])){
            // // echo($_GET['id']);
            // $delete = mysqli_query($conn,"DELETE FROM `hamd` WHERE `id`='$id'");
            //     };

        ?>
              <div class="card ml-3" width = "25rem">
                <img
                  src="<?php echo $value["image"] ?>"
                  class="card-img-top"
                  alt="..."
                  height="300px"
                />
                <div class="card-body">
                  <h5 class="card-title"><?php echo $value["title"] ?></h5>
                  <p class="card-text">
                    <?php echo $value["discription"]; ?>
                  </p>
                  <h3>Price: <span><?php echo $value["price"] ?>$</span></h3>
                  <div class="d-flex gap-5 justify-content-around">
                    <form action="">
                      <button class="btn btn-danger" name ="dlName" value = "<?php echo $value['id'];?>" data-href="/delete.php?id=54" data-toggle="modal" data-target="#confirm-delete">
                      Delete
                      </button>
                    </form>
                      
                      <a
                    href = "red.php?<?php $value["id"]; ?>"
                    name = "id"
                      type="button"
                      class="btn btn-primary"
                      data-toggle="modal"
                      data-target="#exampleModal"
                    >
                      Edit
                   </a>
                  </div>
                </div>
              </div>

              <!-- MODAL DELETE -->
              <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            ...
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" name = "delete">Cancel</button>
                            <a href="index.php?deleteCard=<?php ;?>" name = "" value = "">Delete</a>
                        </div>
                    </div>
                </div>
              </div>

        <?php
        };

      //   if (isset($_GET['delete'])) {
      //     $delet = $_GET['deleteCard'];
      //     $reqDelet = "DELETE FROM `announce` WHERE id='$delet'";
      //     $resulte = mysqli_query($conn, $reqDelet);
      // }
      //   if ($resulte) {
      //     echo "la resultat valid";
      //   } else {
      //     echo $_GET['dlName'];
      //   }
        ?>
        </div>

      </section>
    </main>

    <!--========================  Footer ======================================-->
<footer class="text-center text-lg-start text-muted bg-light">
  <!-- Section: Social media -->
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
      <span>social networks:</span>
    </div>
    <div>
      <a href="" class="me-4 link-secondary">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="" class="me-4 link-secondary">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="" class="me-4 link-secondary">
        <i class="fab fa-google"></i>
      </a>
      <a href="" class="me-4 link-secondary">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="" class="me-4 link-secondary">
        <i class="fab fa-linkedin"></i>
      </a>
      <a href="" class="me-4 link-secondary">
        <i class="fab fa-github"></i>
      </a>
    </div>
  </section>
  <section class="">
    <div class="container text-center text-md-start mt-5">
  </section>
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.025);">
    © 2021 Copyright:
    <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a>
  </div>
</footer>

    <!-- link js bootsrap -->
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
    <!-- link java script -->
    <script src="script.js"></script>
  </body>
</html>
