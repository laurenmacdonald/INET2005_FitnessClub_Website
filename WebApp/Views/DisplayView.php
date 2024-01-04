<?php

namespace Views;
include_once (__DIR__.'/View.php');

/**
 * View for displaying class and trainer information on website.
 */
class DisplayView extends View
{
    /**
     * Take the list of trainers as a parameter, iterate through the list (if not null) to display the information in a
     * card on the website.
     * @param $trainerList
     * @return void
     */
    public function showAllTrainers($trainerList): void
    {
        if($trainerList == null ){
            echo "<div class='container'>
                  <div class='alert alert-info' role='alert'>No trainers.</div></div>";
        }
        echo '<div class="container-md pt-3">
                  <h2>Our Trainers</h2>
        <div class="row row-cols-1 row-cols-md-4 g-4">
        ';
        foreach($trainerList as $trainer){
            echo'<div class="col">
                    <div class="card">
                          <img src="../../include/'.$trainer['imgPath'].'.jpg" class="card-img-top" alt="Trainer bio picture">
                          <div class="card-body">
                            <h5 class="card-title">'.$trainer['TrainerName'].'</h5>
                            <p class="card-text">'.$trainer['description'].'</p>
                          </div>
                        </div>
                      </div>
                      ';
        }
        echo '</div></div>
<footer class="py-3 mt-4 absolute">
    <p class="text-center text-muted">Lauren MacDonald W0230178</p>
    <p class="text-center text-muted"><a href="https://www.freepik.com/author/stories">Images by storyset</a> on Freepik</p>
</footer>
</body>
</html>';
    }

    /**
     * Take the list of classes as a parameter, iterate through the list (if not null) to display the information in a
     * card on the website
     * @param $classList
     * @return void
     */
    public function showAllClasses($classList): void
    {
        if($classList == null ){
            echo "<div class='container'>
                  <div class='alert alert-info' role='alert'>No trainers.</div></div>";
        }
        echo '<div class="container-md pt-3">
                  <h2>Our Classes</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
        ';
        foreach($classList as $class){
            echo'<div class="col">
                    <div class="card">
                          <img src="../../include/'.$class['classImgPath'].'.jpg" class="card-img-top" alt="Fitness class">
                          <div class="card-body">
                            <h5 class="card-title">'.$class['className'].'</h5>
                            <p class="card-text">'.$class['classDescription'].'</p>
                          </div>
                        </div>
                      </div>
                      ';
        }
        echo '</div></div>
<footer class="py-3 mt-4 absolute">
    <p class="text-center text-muted">Lauren MacDonald W0230178</p>
    <p class="text-center text-muted"><a href="https://www.freepik.com/author/javi-indy">Images by javi_indy</a> on Freepik
</footer>
</body>
</html>';
    }
}

