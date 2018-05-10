<?php 
use app\models\Job;
?>

<div class="container">
  
  <!-- Recent Jobs -->
  <div class="eleven columns">
  <div class="padding-right">
    <h3 class="margin-bottom-25">Recent Jobs</h3>
    <ul class="job-list">

    <?php 
      $query = Job::find()->all();
      $i = 0;
      foreach ($query as  $val) {
       // print_r($val);
         
        if($i <= 5)
        {
        ?>
           <li class="highlighted"><a href="/job/view?id=<?php echo $val['job_id'];?>" >
        <img src="images/job-list-logo-01.png">
        <div class="job-list-content">
          <h4><?php print_r($val['title']); ?><span class="full-time">Full-Time</span></h4>
          <div class="job-icons">
            <span><i class="fa fa-briefcase"></i> <?php print_r($val['industry']); ?></span>
            <span><i class="fa fa-map-marker"></i><?php print_r($val['location']); ?> </span>
            <span><i class="fa fa-money"></i><?php if(empty($val['salary']))echo 'salary not disclosed';else print_r($val['salary']); ?></span>
          </div>
        </div>
        </a>
        <div class="clearfix"></div>
      </li>

<?php    } $i = $i+1; }
    ?>


     
    </ul>

    <a href="/user-management/auth/login" class="button centered"><i class="fa fa-plus-circle"></i> Show More Jobs</a>
    <div class="margin-bottom-55"></div>
  </div>
  </div>


    <!-- Job Spotlight -->
  <div class="five columns">
    <h3 class="margin-bottom-5">Job Spotlight</h3>

    <!-- Navigation -->
    <div class="showbiz-navigation">
      <div id="showbiz_left_1" class="sb-navigation-left"><i class="fa fa-angle-left"></i></div>
      <div id="showbiz_right_1" class="sb-navigation-right"><i class="fa fa-angle-right"></i></div>
    </div>
    <div class="clearfix"></div>


    <!-- Showbiz Container -->
    <div id="job-spotlight" class="showbiz-container">
      <div class="showbiz" data-left="#showbiz_left_1" data-right="#showbiz_right_1" data-play="#showbiz_play_1" >
        <div class="overflowholder">

          <ul>
 <?php 
      $query = Job::find()->all();
      $i = 0;
      foreach ($query as  $val) {
       // print_r($val);
         
        if($i <= 5)
        {
        ?>
           <li>
            <div class="job-spotlight">
            <a href="#" ><h4><?php print_r($val['title']); ?><span class="part-time">Part-Time</span></h4></a>
            <span><i class="fa fa-briefcase"></i> <?php print_r($val['industry']); ?></span>
            <span><i class="fa fa-map-marker"></i><?php print_r($val['location']); ?> </span>
            <span><i class="fa fa-money"></i><?php if(empty($val['salary']))echo 'salary not disclosed';else print_r($val['salary']); ?></span>
           <a href="/job/view?id=<?php echo $val['job_id'];?>" class="button">View Job Details</a>
         </div>
      </li>

<?php    } $i = $i+1; }
    ?>
          </ul>
          <div class="clearfix"></div>

        </div>
        <div class="clearfix"></div>
      </div>
    </div>

  </div>
</div>

</div>
<!-- Testimonials -->
<div id="testimonials">
  <!-- Slider -->
  <div class="container">
    <div class="sixteen columns">
      <div class="testimonials-slider">
          <ul class="slides">
            <li>
              <p>I have already heard back about the internship I applied through Job Finder, that's the fastest job reply I've ever gotten and it's so much better than waiting weeks to hear back.
              <span>Collis Ta’eed, Envato</span></p>
            </li>

            <li>
              <p>Nam eu eleifend nulla. Duis consectetur sit amet risus sit amet venenatis. Pellentesque pulvinar ante a tincidunt placerat. Donec dapibus efficitur arcu, a rhoncus lectus egestas elementum.
              <span>John Doe</span></p>
            </li>
            
            <li>
              <p>Maecenas congue sed massa et porttitor. Duis placerat commodo ex, ut faucibus est facilisis ac. Donec eleifend arcu sed sem posuere aliquet. Etiam lorem metus, suscipit vel tortor vitae.
              <span>Tom Smith</span></p>
            </li>

          </ul>
      </div>
    </div>
  </div>
</div>


<!-- Infobox -->
<div class="infobox">
  <div class="container">
    <div class="sixteen columns">Start Building Your Own Job Board Now <a href="/user-management/auth/login">Get Started</a></div>
  </div>
</div>


    <script type="text/javascript">
        function scrollTo() {
            $('html, body').animate({ scrollTop: $('#div_id').offset().top }, 'slow');
            return false;
        }
    </script>


  




