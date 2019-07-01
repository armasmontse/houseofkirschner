<?php

get_header();

if (have_posts()) : while (have_posts()) : the_post();

$images = glob( __DIR__ . '/images/slider/*.jpg' );
$about = include(__DIR__ . '/inc/about.php');

$video_paths = [
  'mp4' => wp_upload_dir()['baseurl'] . '/HOK_videoCamilaFernandoWeb02.mp4',
  'ogg' => wp_upload_dir()['baseurl'] . '/HOK_videoCamilaFernandoWeb02.ogv',
  'webm' => wp_upload_dir()['baseurl'] . '/HOK_videoCamilaFernandoWeb02.webm',
];

?>

<nav class="nav">
    <ul>
        <li><a href="https://www.facebook.com/houseofkirschner" target="_blank">Facebook</a></li>
        <li><a href="https://www.instagram.com/houseofkirschner/" target="_blank">Instagram</a></li>
        <li><a class="hidden-under-sm open" data-target="about" href="#about">About</a></li>
        <li><a class="open" data-target="contact" href="#contact">Contact</a></li>
    </ul>
</nav>

<div class="home__container">
    <!-- Div con posición relativa que va de 50% a 100% -->
     <div class="home__half home__half--left">
        <!-- Div que va a estar al 100% de la página. top: 0; right: 0; -->
        <div class="home__screen home__screen--left">
            <video playsinline muted preload class="home__resource">
                <?php foreach ($video_paths as $type => $video_path):?>
                    <source  src="<?php echo esc_url( $video_path ); ?>" type="video/<?php echo $type; ?>">
                <?php endforeach;?>
                <img class="home__resource" src="<?php echo THEMEURL . 'images/video.jpg'; ?>" />
            </video>
            <!-- Status del audio -->
            <span id="audio-status">AUDIO</span>
            <!-- Logo que aparece los primeros dos segundos -->
            <div class="home__logo" id="first-logo">
                <img class="logo" src="<?php echo THEMEURL . 'images/logo.png'; ?>" alt="">
            </div>
            <div class="home__overlay" style="cursor: pointer;"></div>
        </div>
        <!-- Div que va a estar flotando y que va a estar a 50% -->
        <div class="home__float home__float--left">
            <div class="home__logo home__logo--left" id="logo-left">
                <img class="logo" src="<?php echo THEMEURL . 'images/logo.png'; ?>" alt="">
            </div>
        </div>
     </div>
     <!-- Div con posición relativa que va de 50% a 100% -->
     <div class="home__half home__half--right">
        <!-- Div que va a estar al 100% de la página: top: 0; right: 0; -->
        <div class="home__screen home__screen--right">
            <div class="slider">
                <div class="slide">
                    <img class="home__resource" src="<?php echo THEMEURL . 'images/video.jpg'; ?>" alt="">
                </div>
                <?php foreach($images as $image): ?>
                    <div class="slide">
                        <img class="home__resource" src="<?php echo THEMEURL . 'images/slider/' . basename($image); ?>" alt="">
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- Div que va a estar flotando y que va a estar a 50% -->
            <div class="home__float home__float--right">
                <div class="home__logo home__logo--right" style="opacity: 1;">
                    Dare to dream
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ABOUT -->
<div class="home__about">
    <div class="home__container first__col--pink">
        <?php echo $about; ?>
    </div>
</div>

<div class="home__gallery">
     <?php foreach($images as $image): ?>
     <div class="home__container">
          <img class="home__resource" src="<?php echo THEMEURL . 'images/slider/' . basename($image); ?>" alt="">
     </div>
     <?php endforeach; ?>
     <div class="home__container">
          <img class="home__resource" src="<?php echo THEMEURL . 'images/3.jpg' ?>" alt="">
     </div>
</div>

<div class="modal" id="contact">
    <button class="close">&times;</button>
    <div class="content">
        <div class="box">
            <p>
                <a href="mailto:info@houseofkirschner.com" target="_blank">info@houseofkirschner.com</a>
            </p>
            <p>
               <a href="https://www.google.com/maps/place/Campos+El%C3%ADseos+60,+Polanco,+Polanco+V+Secc,+11560+Ciudad+de+M%C3%A9xico,+CDMX/@19.4302854,-99.187534,17z/data=!3m1!4b1!4m5!3m4!1s0x85d1ff54b140e74d:0xe6714264b63a02cb!8m2!3d19.4302854!4d-99.1853453" target="_blank">
                    Campos Elíseos N. 60, Polanco, Mexico City <br>
               </a>
               <a class="modal__phone" href="tel:+55 5925 7515" target="_blank">+55 5925 7515</a>
            </p>
        </div>
    </div>
</div>

<div class="modal" id="about">
     <button class="close">&times;</button>
     <div class="content">
        <div class="box">
            <?php echo $about; ?>
        </div>
     </div>
</div>

<?php

endwhile; endif;

get_footer();
