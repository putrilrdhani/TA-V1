<?= $this->extend('web/layouts/main_home'); ?>


<h1><?= $this->section('content') ?></h1>


<section class="section">
    <div class="row">
        <div style="margin-bottom: 40px; margin-top: 20px" class="col-md-10">

            <h1>Payo Tourism Village</h1>
        </div>
        <div class="col-md-2" style="margin-bottom: 40px; margin-top: 20px">
            <!-- <button class="btn btn-sm btn-primary" href="<?= base_url('login'); ?>" style="height: 50px; width: 110px">LOG IN <i class="fa fa-sign-in" aria-hidden="true"></i></button> -->




        </div>
    </div>
    <div style="margin-inline: 20%; margin-bottom: 50px;" class="row">

        <script>
            $('#title').hide();
        </script>
        <!-- New -->
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="<?= base_url('media/photos/home/Agrowisata1.jpg') ?>" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="<?= base_url('media/photos/home/Puncak Bidadari1.jpg') ?>" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="<?= base_url('media/photos/home/Agrowisata2.jpg') ?>" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

    </div>
    <div class="row">

        <div class="card">


            <div class="card-body">
                <h5 class="card-title">Kampung Wisata Payo</h5>
                <p style="text-justify: auto;" class="card-text"><i class="fa-solid fa-quote-right"></i> &nbsp;merupakan sebuah kawasan pedesaan dengan ketinggian lebih kurang 800 mdpl. Dan di dukung barbagai SDA, kuliner khas, budaya, dan kesenian masyarakat. Pada kesempatan lain, kampung wisata payo juga pernah di kunjungi oleh wali kota toyoyashi, jepang. Payo merupakan salah satu bagian Kelurahan Tanah Garam yang terletak di RT 04/RW 04, Kelurahan Tanah Garam, Kecamatan Lubuk Sikarah Kota Solok (Fahmi & Mariya, 2019). Payo memiliki ketinggian di atas rata-rata, yaitu 900 MDPL dengan cuaca yang dingin dan sejuk di puncak perbukitan. Kampung Wisata Payo memiliki tiga objek wisata, dengan objek wisata utama adalah Batu Patah Payo, yang memiliki nama lain Agrowisata Batu Patah Payo. <i class="fa-solid fa-quote-left"></i></p>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">

            <div class="card" style="width: 18rem;height: fit-content;">
                <img class="card-img-top" src="<?= base_url('media/photos/home/Agrowisata.jpg') ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Agrotourism Batu Patah Payo</h5>
                    <p class="card-text">Agrowisata Payo merupakan salah satu kawasan wisata unggulan di Kota Solok, yang terletak di Kelurahan Tanah Garam Kecamatan Lubuk Sikarah. Kawasan ini berada di ketinggian gugusan bukit barisan memiliki hawa sejuk dan segar khas pebukitan. Hamparan sawah solok yang membentang indah dengan latar belakang gunung talang yang berdiri dengan anggun. Tidak hanya itu, pengunjung juga akan dimanjakan dengan pemandangan danau singkarak yang sangat mempesona.</p>
                    <a href="<?= base_url('web/detail/T3'); ?>" class="btn btn-primary">Information</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card" style="width: 18rem;height: fit-content;">
                <img class="card-img-top" src="<?= base_url('media/photos/home/Payo Nature.jpg') ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Payo Nature</h5>
                    <p class="card-text">Payo Nature merupakan objek wisata lain yang terdapat di kampung wisata payo. Dengan pemandangan alam yang memukau, bentangan sawah di Kota Solok dan indahnya Danau Singkarak dapat dilihat dari Payo Nature. Payo Nature merupakan tempat yang cocok untuk melepas penat dalam hiruk pikuk kehidupan.</p>
                    <a href="<?= base_url('web/detail/T1'); ?>" class="btn btn-primary">Information</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card" style="width: 18rem;height: fit-content;">
                <img class="card-img-top" src="<?= base_url('media/photos/home/Puncak Bidadari.jpg') ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Puncak Bidadari</h5>
                    <p class="card-text">Puncak Bidadari merupakan objek wisata olahraga yang disediakan untuk kegiatan paralayang. Selain itu Puncak Bidadari juga disiapkan sebagai lokasi take off olahraga paralayang tingkat Sumatera Barat. </p>
                    <a href="<?= base_url('web/detail/T2'); ?>" class="btn btn-primary">Information</a>
                </div>
            </div>
        </div>
    </div>







    </div>

    <!-- Direction section -->

</section>

<?= $this->endSection() ?>