<?php
    include_once './includes/header.php'
?>
  <style>
    .nav {
        background-color: rgb(15, 66, 124);
      }
    .nav-item {
        border: 0%;
      }
    .jumbotron {
        background-color: rgb(103, 172, 250) !important;
        text-align: center;
        border-bottom-left-radius: 10%;
        border-bottom-right-radius: 10%;
        margin-bottom: 5% !important;
      }
    .container {
        text-align: center;
      }
    .h2_class {
        font-weight: bold;
        margin-bottom: 5%;
      }
    h3 {
        font-weight: bold !important;
      }
    p {
        font-size: 20px;
      }
    .p_ourwork {
        margin-bottom: 10%;
      }
    .p_ourmission {
        margin-bottom: 10%;
      }
    .team_img {
        margin-top: 5%;
        border-radius: 50%;
        max-height: 70%;
        max-width: 70%;
        margin-bottom: 10%;
        filter: grayscale(70%);
      }
  </style>

  <div class="jumbotron">
    <h1>About Peace of Mind</h1>
  </div>
  <div class="container">
    <div class="row">
        <h2 class="h2_class">Our Work</h2>
        <p class="p_ourwork">We are a group of humans caring about other humans. During the COVID pandemic
            peak, we decided to share our own experiences and create a community where other
            people could share their own experiences as well. A blog, a community where people can
            read wellness comments and apply them to their own life in order to improve and achieve
            peace of mind because people matter.</p>
    </div>
    <div class="row">
        <h2 class="h2_class">Our Mission</h2>
        <p class="p_ourmission">Peace of Mind is a blog for people to share optimistic and diverse storytelling,
            experiences, and points of view to our audience of other people that are going through
            tough times.
            </p>
    </div>
    </div>
    <div class="container">
    <div class="row">
    <h2 class="h2_class">Meet our team!</h2>
      <div class="col-sm-4">
        <a href="https://www.linkedin.com/in/mauricio-retana-cs/" target="_blank">
        <h3>Mauricio Retana</h3>
        <img class ="team_img" src="assets/img/mauricio_resume.jpeg" alt="photo of Mauricio">
        </a>
        <p>Computer Science student at FAU</p>
        <p>President of project</p>
      </div>
      <div class="col-sm-4">
        <a href="https://www.linkedin.com/in/ryan-bharath-a00042206/" target="_blank">
        <h3>Ryan Bharath</h3>
        <img class = "team_img" src="assets/img/ryanB_resume.jpeg" alt="photo of Ryan Bharath">
        </a>
        <p>Computer Engineering student at FAU</p>
        <p>Vice President of project</p>
      </div>
      <div class="col-sm-4">
        <a href="https://www.linkedin.com/in/juan-pablo-idrovo-3366a351/" target="_blank">
        <h3>Juan Pablo Idrovo</h3>
        <img class = "team_img" src="assets/img/jp_resume.jpeg" alt="photo of JP">
        </a>
        <p>Computer Science student at FAU</p>
        <p>Team Member</p>
      </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
        <a href="https://www.linkedin.com/in/armaghan-ali-7b5b27150/" target="_blank">
          <h3>Armaghan Ali</h3>
          <img class = "team_img" src="assets/img/ali_resume.jpeg" alt="photo of Ali">
        </a>
            <p>Computer Science student at FAU</p>
            <p>Master</p>
        </div>
        <div class="col-sm-4">
            <a href="" target="_blank">
            <h3>Ryan Milrad</h3>
          <img class = "team_img" src="assets/img/ryanM_resume.jpeg" alt="photo of Ryan Milrad">
            </a>
            <p>Computer Science student at FAU</p>
            <p>Lead back-end</p>
        </div>
        <div class="col-sm-4">
        <a href="" target="_blank">
        <h3>Joseph</h3>
          <img class = "team_img" src="assets/img/joseph_resume.jpeg" alt="photo of Joseph">
            </a>
          <p>Computer Science student at FAU</p>
            <p>Team Member</p>
        </div>
      </div>
  </div>
<?php
    include_once './includes/footer.php'
?>